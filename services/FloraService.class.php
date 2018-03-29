<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/FloraData.class.php';
require_once '../models/Flora.class.php';
require_once 'TrackableObjectService.class.php';

class FloraService extends TrackableObjectService {

    private $floraData;
    private $trackableObjectService;

    /**
     * FloraService constructor.
     * @param $floraData
     */
    public function __construct()
    {
        $this->floraData = new FloraData();
        $this->trackableObjectService = new TrackableObjectService();
    }


    public function readAllFlora(){
        $floras = $this->floraData->readAllFlora();
        $allFlora = array();

        foreach($floras as $obj){
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

    public function createFlora($commonName, $scientificName, $description,
                                $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){

        // Sanitize
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $lastFloraID = $this->floraData->createFlora($commonName, $scientificName, $description);
        $lastTrackableObjectID = $this->trackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->trackableObjectService->updateReferencedTrackableObject($lastTrackableObjectID, $lastFloraID, "Flora");
    }

    public function updateFlora($idFlora, $commonName, $scientificName, $description,
                                $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){

        $idFlora = filter_var($idFlora, FILTER_SANITIZE_NUMBER_INT);
        $commonName = filter_var($commonName, FILTER_SANITIZE_STRING);
        $scientificName = filter_var($scientificName, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this->floraData->updateFlora($idFlora, $commonName, $scientificName, $description);
        $this->trackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
    }

    public function deleteFlora($idFlora){
        $idFlora = filter_var($idFlora, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idFlora, "Flora");
    }

    /**
     * Admin CRUD Styling
     */
    public function readFloraTable(){
        $data = $this->readAllFlora();

        $table = "<script>
                        var grave = 'Flora';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>Flora</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, flora, -1)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Common Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getCommonName()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, grave, ".$obj->getIdFlora().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, grave, ".$obj->getIdFlora().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table>";

        return $table;

    }


}

?>