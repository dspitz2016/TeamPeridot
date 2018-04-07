<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../data/FloraData.class.php';
require_once '../models/Flora.class.php';
require_once 'TrackableObjectService.class.php';
require_once 'LocationService.class.php';

class FloraService extends TrackableObjectService
{

    private $floraData;
    private $trackableObjectService;
    private $locationService;

    /**
     * FloraService constructor.
     * @param $floraData
     */
    public function __construct()
    {
        $this->floraData = new FloraData();
        $this->trackableObjectService = new TrackableObjectService();
        $this->locationService = new LocationService();
    }


    public function readAllFlora()
    {
        $floras = $this->floraData->readAllFlora();
        $allFlora = array();

        foreach ($floras as $obj) {
            $newFlora = new Flora(
                $obj['idFlora'],
                $obj['commonName'],
                $obj['scientificName'],
                $obj['description'],
                $obj['idTrackableObject'],
                $obj['longitude'],
                $obj['latitude'],
                $obj['scavengerHuntHint'],
                $obj['imagePath'],
                $obj['imageDescription'],
                $obj['idLocation'],
                $obj['idType']
            );

            array_push($allFlora, $newFlora);
        };

        return $allFlora;
    }

    public function getFloraById($idFlora)
    {
        $idFlora = filter_var($idFlora, FILTER_SANITIZE_NUMBER_INT);
        $obj = $this->floraData->getFloraById($idFlora);
        $singleFlora = new Flora(
            $obj[0]['idFlora'],
            $obj[0]['commonName'],
            $obj[0]['scientificName'],
            $obj[0]['description'],

            $obj[0]['idTrackableObject'],
            $obj[0]['longitude'],
            $obj[0]['latitude'],
            $obj[0]['scavengerHuntHint'],
            $obj[0]['imagePath'],
            $obj[0]['imageDescription'],
            $obj[0]['idLocation'],
            $obj[0]['idType']
        );

        return $singleFlora;
    }

    public function createFlora($commonName, $scientificName, $description,
                                $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {

        // Sanitize
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $lastFloraID = $this->floraData->createFlora($commonName, $scientificName, $description);
        $lastTrackableObjectID = $this->trackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->trackableObjectService->updateReferencedTrackableObject($lastTrackableObjectID, $lastFloraID, "Flora");
    }

    public function updateFlora($idFlora, $commonName, $scientificName, $description,
                                $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {

        $idFlora = filter_var($idFlora, FILTER_SANITIZE_NUMBER_INT);
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this->floraData->updateFlora($idFlora, $commonName, $scientificName, $description);
        $this->trackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
    }

    public function deleteFlora($idFlora)
    {
        $idFlora = filter_var($idFlora, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idFlora, "Flora");
    }

    /**
     * Admin CRUD Styling
     */
    public function readFloraTable()
    {
        $data = $this->readAllFlora();

        $table = "<script>
                        var flora = 'Flora';
                    </script>";
        $table .= "
                    <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Flora</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, flora, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Common Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach ($data as $obj) {
            $table .= "
                      <tr>
                        <td>" . $obj->getCommonName() . "</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, flora, " . $obj->getIdFlora() . ")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, flora, " . $obj->getIdFlora() . ")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table></div></div>";

        return $table;

    }


    public function createFloraForm()
    {
        return '
                        <div class="row"><div class="col s12"><h5>Create Flora</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="commonName">Common Name</label>
                                <input id="commonName" name="commonName" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="scientificName">Scientific Name</label>
                                <input id="scientificName" name="scientificName" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                            </div>
                        </div>'
            . $this->locationService->getDefaultLocationDropdown()
            . $this->trackableObjectService->getCreateTrackableObjectFormElements();
    }

    public function updateFloraForm($idFlora)
    {
        $singleFlora = $this->getFloraById($idFlora);
        return '
                        <div class="row"><div class="col s12"><h5>Update Flora</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="commonName">Common Name</label><br/>
                                <input id="commonName" name="commonName" type="text" class="validate" required="" aria-required="true" value="' . $singleFlora->getCommonName() . '">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="scientificName">Scientific Name</label><br/>
                                <input id="scientificName" name="scientificName" type="text" class="validate" required="" aria-required="true" value="' . $singleFlora->getScientificName() . '">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label><br/>
                                <textarea id="description" name="description" class="materialize-textarea">' . $singleFlora->getDescription() . '</textarea>
                            </div>
                        </div>
                        
                        <div class="row" style="display:none;">
                           <div class="input-field col s12">
                                <input id="idFlora" name="idFlora" type="text" class="validate" required="" aria-required="true" value="' . $singleFlora->getIdFlora() . '">
                            </div>
                        </div>
                        '
            . $this->locationService->getDefaultLocationDropdown()
            . $this->trackableObjectService->getTrackableObjectFormElementsByObject($singleFlora);
    }
}

?>