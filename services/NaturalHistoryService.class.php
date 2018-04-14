<?php

require_once '../data/NaturalHistoryData.class.php';
require_once '../models/NaturalHistory.class.php';
require_once 'TrackableObjectService.class.php';
require_once 'LocationService.class.php';
require_once 'TypeFilterService.class.php';

class NaturalHistoryService extends TrackableObjectService
{

    private $trackableObjectService;
    private $naturalHistoryData;
    private $locationService;
    private $typeFilterService;

    /**
     * NaturalHistoryService constructor.
     * @param $trackableObjectService
     * @param $naturalHistoryData
     */
    public function __construct()
    {
        $this->trackableObjectService = new TrackableObjectService();
        $this->naturalHistoryData = new NaturalHistoryData();
        $this->locationService = new LocationService();
        $this->typeFilterService = new TypeFilterService();
    }

    public function readAllNaturalHistory()
    {
        $nh = $this->naturalHistoryData->readAllNaturalHistory();
        $allMiscObjects = array();

        foreach ($nh as $obj) {
            $newNH = new NaturalHistory(
                $obj['idNaturalHistory'],
                $obj['name'],
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

            array_push($allMiscObjects, $newNH);
        };

        return $allMiscObjects;
    }

    public function getNaturalHistoryById($idNaturalHistory)
    {
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        $obj = $this->naturalHistoryData->getNaturalHistoryById($idNaturalHistory);
        $singleNH = new NaturalHistory(
            $obj[0]['idNaturalHistory'],
            $obj[0]['name'],
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

        return $singleNH;
    }

    public function createNaturalHistory($name, $description,
                                         $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {
        // Sanitize
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $lastNaturalHistoryID = $this->naturalHistoryData->createNaturalHistory($name, $description);
        $lastTrackableObjectID = $this->trackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->trackableObjectService->updateReferencedTrackableObject($lastTrackableObjectID, $lastNaturalHistoryID, "NaturalHistory");
    }

    public function updateNaturalHistory($idNaturalHistory, $name, $description,
                                         $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this->naturalHistoryData->updateNaturalHistory($idNaturalHistory, $name, $description);
        $this->trackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

    }

    public function deleteNaturalHistory($idNaturalHistory)
    {
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idNaturalHistory, "NaturalHistory");
    }

    public function readNaturalHistoryTable()
    {
        $data = $this->readAllNaturalHistory();

        $table = "<script>
                        var misc = 'Miscellaneous';
                    </script>";
        $table .= "
                    <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Miscellaneous</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, misc, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach ($data as $obj) {
            $table .= "
                      <tr>
                        <td>" . $obj->getName() . "</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, misc, " . $obj->getIdNaturalHistory() . ")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, misc, " . $obj->getIdNaturalHistory() . ")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table></div></div>";

        return $table;
    }

    public function createNaturalHistoryForm()
    {
        return '
                        <div class="row"><div class="col s12"><h5>Create Miscellaneous Object</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                            </div>
                        </div>'
            . $this->typeFilterService->getDefaultTypeFilter()
            . $this->locationService->getDefaultLocationDropdown()
            . $this->trackableObjectService->getCreateTrackableObjectFormElements();
    }

    public function updateNaturalHistoryForm($idNaturalHistory)
    {
        $singleNH = $this->getNaturalHistoryById($idNaturalHistory);
        return '
                        <div class="row"><div class="col s12"><h5>Update Natural History</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="name">Name</label><br/>
                                <input id="name" name="name" type="text" class="validate" required="" aria-required="true" value="' . $singleNH->getName() . '">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="description">Description</label><br/>
                                <textarea id="description" name="description" class="materialize-textarea">' . $singleNH->getDescription() . '</textarea>
                            </div>
                        </div>
                        
                        <div class="row" style="display:none;">
                           <div class="input-field col s12">
                                <input id="idNaturalHistory" name="idNaturalHistory" type="text" class="validate" required="" aria-required="true" value="' . $singleNH->getIdNaturalHistory() . '">
                            </div>
                        </div>
                        '
            . $this->typeFilterService->getTypeFilterForObject($singleNH->getIdType())
            . $this->locationService->getDefaultLocationDropdown()
            . $this->trackableObjectService->getTrackableObjectFormElementsByObject($singleNH);
    }


}


?>