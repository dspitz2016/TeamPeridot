<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/GraveData.class.php';
require_once '../models/Grave.class.php';
require_once 'AdminTrackableObjectService.class.php';

/**
 * Class GraveService - Responsible for updating all Grave objects for the application
 * Extends AdminTrackableObject Service - User must add information for both objects in order to update a Grave
 */
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


    /**
     * @return array of php grave objects
     */
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

    /**
     * Creates a new TrackableObject & Grave within the Database
     * Calls AdminTrackableObjectService to create a new Trackable Object
     * Filter values before passing them to the database
     * Calls Grave Data to insert new Grave into the database
     * Updates the TrackableObjects reference to the Grave object
     * @param $firstName
     * @param $middleName
     * @param $lastName
     * @param $birth
     * @param $death
     * @param $description
     * @param $idHistoricFilter
     * @param $longitude
     * @param $latitude
     * @param $scavengerHuntHint
     * @param $imagePath
     * @param $imageDescription
     * @param $idLocation
     * @param $idType
     */
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
    }


    /**
     * Updates associated graves
     * @param $idGrave
     * @param $firstName
     * @param $middleName
     * @param $lastName
     * @param $birth
     * @param $death
     * @param $description
     * @param $idHistoricFilter
     * @param $idTrackableObject
     * @param $longitude
     * @param $latitude
     * @param $scavengerHuntHint
     * @param $imagePath
     * @param $imageDescription
     * @param $idLocation
     * @param $idType
     */
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

    /**
     * @param $idGrave - the grave you want to delete
     * Database is set to cascade delete the TrackableObject if the idGrave is deleted.
     */
    public function deleteGrave($idGrave){
        $idGrave = filter_var($idGrave, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idGrave, "Grave");
    }
}

?>