<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../data/AdminTrackableObjectData.class.php';

class AdminTrackableObjectService {

    private $adminTrackableObjectData;

    /**
     * AdminTrackableObjectService constructor.
     * @param $adminTrackableObjectData
     */
    public function __construct()
    {
        $this->adminTrackableObjectData = new AdminTrackableObjectData();
    }


    // CREATE
    function createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){

        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $scavengerHuntHint = filter_var($scavengerHuntHint, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        $idType = filter_var($idType, FILTER_SANITIZE_NUMBER_INT);

        // Send to Data class
        return $this->adminTrackableObjectData->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
    }

    // UPDATE GRAVE, FLORA, NATURALHISTORY ID
    public function updateReferencedTrackableObject($idTrackableObject, $idReferencedObject, $referenceType){
        $idTrackableObject = filter_var($idTrackableObject, FILTER_SANITIZE_NUMBER_INT);
        $idReferencedObject = filter_var($idReferencedObject, FILTER_SANITIZE_NUMBER_INT);
        $referenceType = filter_var($referenceType, FILTER_SANITIZE_STRING);

        // Send Update to Data layer
        $this->adminTrackableObjectData->updateReferencedTrackableObject($idTrackableObject, $idReferencedObject, $referenceType);
    }

    // UPDATE
    public function updateTrackableObject(){

    }

    // DELETE
    public function deleteTrackableObject(){

    }
}

?>