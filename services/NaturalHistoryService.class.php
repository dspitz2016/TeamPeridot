<?php

require_once '../data/NaturalHistoryData.class.php';
require_once '../models/NaturalHistory.class.php';
require_once 'TrackableObjectService.class.php';

class NaturalHistoryService extends TrackableObjectService {

    private $trackableObjectService;
    private $naturalHistoryData;

    /**
     * NaturalHistoryService constructor.
     * @param $trackableObjectService
     * @param $naturalHistoryData
     */
    public function __construct()
    {
        $this->trackableObjectService = new TrackableObjectService();
        $this->naturalHistoryData = new NaturalHistoryData();
    }

    public function readAllNaturalHistory(){
        $nh = $this->naturalHistoryData->readAllNaturalHistory();
        $allMiscObjects = array();

        foreach($nh as $obj){
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

    public function createNaturalHistory($name, $description,
                                         $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        // Sanitize
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $lastNaturalHistoryID = $this->naturalHistoryData->createNaturalHistory($name, $description);
        $lastTrackableObjectID = $this->trackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->trackableObjectService->updateReferencedTrackableObject($lastTrackableObjectID, $lastNaturalHistoryID, "NaturalHistory");
    }

    public function updateNaturalHistory($idNaturalHistory, $name, $description,
                                         $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this->naturalHistoryData->updateNaturalHistory($idNaturalHistory, $name, $description);
        $this->trackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

    }

    public function deleteNaturalHistory($idNaturalHistory){
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idNaturalHistory, "NaturalHistory");
    }

    public function readNaturalHistoryTable(){
        $data = $this->readAllNaturalHistory();

        $table = "<script>
                        var Miscellaneous = 'Miscellaneous';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>Miscellaneous Objects</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, miscellaneous, -1)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getName()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, grave, ".$obj->getIdNaturalHistory().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, grave, ".$obj->getIdNaturalHistory().")'> Delete
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