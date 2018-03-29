<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/TrackableObjectData.class.php';

/**
 * Class TrackableObjectService
 * Responsible for handling all trackable object information
 * > Filter and sanitizes form data before sending it to the data layer to perform CRUD
 * > Outputs elements for objects that extend this class
 */

class TrackableObjectService {

    private $adminTrackableObjectData;

    /**
     * TrackableObjectService constructor.
     * @param $adminTrackableObjectData
     */
    public function __construct()
    {
        $this->adminTrackableObjectData = new TrackableObjectData();
    }


    // CREATEs a trackable object
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
    public function updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        $idTrackableObject = filter_var($idTrackableObject, FILTER_SANITIZE_NUMBER_INT);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $scavengerHuntHint = filter_var($scavengerHuntHint, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        $idType = filter_var($idType, FILTER_SANITIZE_NUMBER_INT);

        // Update TrackableObject Data
        $this->adminTrackableObjectData->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
    }

    // Generate Trackable Object form elements to be used on any class that extends Trackable object
    public function getTrackableObjectFormElementsByObject($obj){
        return '<div class="row">
                            <div class="input-field col s6">
                                <label for="longitude">Longitude</label><br/>
                                <input id="longitude" name="longitude" type="text" value="'.$obj->getLongitude().'">
                            </div>
                            <div class="input-field col s6">
                                <label for="latitude">Latitude</label><br/>
                                <input id="latitude" name="latitude" type="text" value="'.$obj->getLatitude().'">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="scavengerHuntHint">Scavenger Hunt Hint</label><br/>
                                <input id="scavengerHuntHint" name="scavengerHuntHint" type="text" value="'.$obj->getScavengerHuntHint().'">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imagePath">Path to Image</label><br/>
                                <input id="imagePath" name="imagePath" type="text" value="'.$obj->getImagePath().'">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imageDescription">Image Description</label><br/>
                                <input id="imageDescription" name="imageDescription" type="text" value="'.$obj->getImageDescription().'">
                            </div>
                        </div>
                        
                         <div class="row" style="display:none;">
                            <div class="input-field col s12">
                                <input id="idTrackableObject" name="idTrackableObject" type="text" value="'.$obj->getIdTrackableObject().'">
                            </div>
                        </div>';
    }

    public function getCreateTrackableObjectFormElements(){
        return  '<div class="row">
                            <div class="input-field col s6">
                                <label for="longitude">longitude</label><br/>
                                <input id="longitude" name="longitude" type="text" required="" aria-required="true">
                            </div>
                            <div class="input-field col s6">
                                <label for="latitude">latitude</label><br/>
                                <input id="latitude" name="latitude" type="text" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="scavengerHuntHint">Scavenger Hunt Hint</label><br/>
                                <input id="scavengerHuntHint" name="scavengerHuntHint" type="text" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imagePath">Image Path</label><br/>
                                <input id="imagePath" name="imagePath" type="text" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imageDescription">Image Description</label><br/>
                                <input id="imageDescription" name="imageDescription" type="text" required="" aria-required="true">
                            </div>
                        </div>';
    }
}

?>