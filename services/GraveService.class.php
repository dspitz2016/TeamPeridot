<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../data/GraveData.class.php';
include '../models/Grave.class.php';
include 'AdminTrackableObjectService.class.php';

class GraveService extends AdminTrackableObjectService {

    private $adminTrackableObjectService;
    private $graveData;

    /**
     * GraveService constructor.
     * @param $adminTrackableData
     * @param $graveData
     */
    public function __construct()
    {
        parent::__construct();
        $this->adminTrackableObjectService = new AdminTrackableObjectService();
        $this->graveData = new GraveData();
    }


    public function readAllGravesAsObjects(){
        $graves = $this->graveData->readAllGraves();
        $allGraves = array();

        foreach($graves as $grave){
            $newGrave = new Grave(
                $grave['idGrave'],
                $grave['firstName'],
                $grave['middleName'],
                $grave['lastName'],
                $grave['birth'],
                $grave['death'],
                $grave['description'],
                $grave['idHistoricFilter'],
                $grave['idTrackableObject'],
                $grave['longitude'],
                $grave['latitude'],
                $grave['scavengerHuntHint'],
                $grave['imagePath'],
                $grave['imageDescription'],
                $grave['idLocation'],
                $grave['idType']
            );

            array_push($allGraves, $newGrave);
        };

        return $allGraves;
    }

    // CREATE
    public function createGrave($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter,
                                $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){

        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $middleName = filter_var($middleName, FILTER_SANITIZE_STRING);
        $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        $birth = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($birth)));
        $death = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($birth)));
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_STRING);

        if (empty($idHistoricFilter) || $idHistoricFilter == "") {
            $idHistoricFilter = null;
        }

        // Create a trackable object
        $lastIdTrackableObject = $this->adminTrackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

        // Create a Grave Object
        $lastIdGrave = $this->graveData->createGrave($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter);

        // Update Trackable object with GraveID
        $this->adminTrackableObjectService->updateReferencedTrackableObject($lastIdTrackableObject, $lastIdGrave, "Grave");

        return $lastIdTrackableObject . " " . $lastIdTrackableObject;
    }


    // UPDATE
    public function updateGrave($idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter,
                                $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){

        $idGrave = filter_var($idGrave, FILTER_SANITIZE_NUMBER_INT);
        $firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        $middleName = filter_var($middleName, FILTER_SANITIZE_STRING);
        $lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        $birth = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($birth)));
        $death = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($birth)));
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_STRING);

        if (empty($idHistoricFilter) || $idHistoricFilter == "") {
            $idHistoricFilter = null;
        }

        // Update Trackable Object
        $this->adminTrackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

        // Update Grave Object
        $this->graveData->updateGrave($idGrave, $firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter);

    }

    // DELETE
    public function deleteGrave($idGrave){

    }
}

?>