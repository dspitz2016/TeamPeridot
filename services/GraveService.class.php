<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/GraveData.class.php';
require_once '../models/Grave.class.php';
require_once 'TrackableObjectService.class.php';


/**
 * Class GraveService - Responsible for updating all Grave objects for the application
 * Extends AdminTrackableObject Service - User must add information for both objects in order to update a Grave
 */
class GraveService extends TrackableObjectService {

    private $trackableObjectService;
    private $graveData;

    /**
     * GraveService constructor.
     * @param $adminTrackableData
     * @param $graveData
     */
    public function __construct()
    {
        $this->trackableObjectService = new TrackableObjectService();
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

    public function readSingleGrave(){

    }

    public function getGraveByID($idGrave){
        $idGrave = filter_var($idGrave, FILTER_SANITIZE_NUMBER_INT);
        $grave = $this->graveData->getGraveByID($idGrave);
        $singleGrave = new Grave(
            $grave[0]['idGrave'],
            $grave[0]['firstName'],
            $grave[0]['middleName'],
            $grave[0]['lastName'],
            $grave[0]['birth'],
            $grave[0]['death'],
            $grave[0]['description'],
            $grave[0]['idHistoricFilter'],
            $grave[0]['idTrackableObject'],
            $grave[0]['longitude'],
            $grave[0]['latitude'],
            $grave[0]['scavengerHuntHint'],
            $grave[0]['imagePath'],
            $grave[0]['imageDescription'],
            $grave[0]['idLocation'],
            $grave[0]['idType']
        );

        return $singleGrave;
    }

    /**
     * Creates a new TrackableObject & Grave within the Database
     * Calls TrackableObjectService to create a new Trackable Object
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
        $lastIdTrackableObject = $this->trackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

        // Create a Grave Object
        $lastIdGrave = $this->graveData->createGrave($firstName, $middleName, $lastName, $birth, $death, $description, $idHistoricFilter);

        // Update Trackable object with GraveID
        $this->trackableObjectService->updateReferencedTrackableObject($lastIdTrackableObject, $lastIdGrave, "Grave");
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
        $this->trackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

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

    public function readGravesTable(){
        $data = $this->readAllGravesAsObjects();

        $table = "<script>
                        var grave = 'Grave';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>Graves</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, grave, 0)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Birth</th>
                          <th>Death</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getFullName()."</td>
                        <td>".$obj->getBirth()."</td>
                        <td>".$obj->getDeath()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, grave, ".$obj->getIdGrave().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, grave, ".$obj->getIdGrave().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table>";

        return $table;
    }

    public function createGraveForm(){
        return '<div class="row">
                    <form class="col s12" method="POST" action="">
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="firstName" type="text" class="validate">
                                <label for="firstName">First Name</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="middleName" type="text" class="validate">
                                <label for="middleName">Middle Name</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="lastName" type="text" class="validate">
                                <label for="lastName">Last Name</label>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="birth">Birth</label><br/>
                                <input id="birth" type="date">
                            </div>
                            <div class="input-field col s6">
                                <label for="death">Death</label><br/>
                                <input id="death" type="date">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" class="materialize-textarea"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="longitude">longitude</label><br/>
                                <input id="longitude" type="text">
                            </div>
                            <div class="input-field col s6">
                                <label for="latitude">latitude</label><br/>
                                <input id="latitude" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="scavengerHuntHint">Scavenger Hunt Hint</label><br/>
                                <input id="scavengerHuntHint" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imagePath">Image Path</label><br/>
                                <input id="imagePath" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imageDescription">Image Description</label><br/>
                                <input id="imageDescription" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                            </button>
                        </div>
                    </form>
                </div>';
    }

    public function updateGraveForm($graveId){
        $singleGrave = $this->getGraveByID($graveId);

        $firstName = $singleGrave->getFirstName();
        $middleName = $singleGrave->getMiddleName();
        $lastName = $singleGrave->getLastName();

        $updateform = '<div class="row">
                    <form class="col s12" method="POST" action="">
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="firstName" type="text" class="validate" value="'.$singleGrave->getFirstName().'"><br/>
                                <label for="firstName">FirstName</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="middleName" type="text" class="validate active" value="'. $singleGrave->getMiddleName().'">
                                <label for="middleName"></label>
                            </div>
                            <div class="input-field col s4">
                                <input id="lastName" type="text" class="validate" value="'.$singleGrave->getLastName().'">
                                <label for="lastName"></label>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="birth">Birth</label><br/>
                                <input id="birth" type="date" value ="'.$singleGrave->getBirth().'">
                            </div>
                            <div class="input-field col s6">
                                <label for="death">Death</label><br/>
                                <input id="death" type="date" value="'.$singleGrave->getDeath().'">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" class="materialize-textarea"></textarea>
                                <label for="description">'.$singleGrave->getDescription().'</label>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="longitude">'.$singleGrave->getLongitude().'</label><br/>
                                <input id="longitude" type="text">
                            </div>
                            <div class="input-field col s6">
                                <label for="latitude">'.$singleGrave->getLatitude().'</label><br/>
                                <input id="latitude" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="scavengerHuntHint">'.$singleGrave->getScavengerHuntHint().'</label><br/>
                                <input id="scavengerHuntHint" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imagePath">'.$singleGrave->getImagePath().'</label><br/>
                                <input id="imagePath" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imageDescription">'.$singleGrave->getImageDescription().'</label><br/>
                                <input id="imageDescription" type="text">
                            </div>
                        </div>
            
                        <div class="row">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                            </button>
                        </div>
                    </form>
                </div>';

        return $updateform;
    }
}

?>