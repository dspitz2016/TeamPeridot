<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/LocationData.class.php';
require_once '../models/Location.class.php';

/**
 * Used to generate the Location modals on the wider area map
 * onclick a button sends an ajax get request providing idLocation which is used to get the information for the modal
 */
if(isset($_GET['idLocation'])){
    $locationService = new LocationService();
    $data = $locationService->getLocationModalInfo($_GET['idLocation']);
    var_dump($data);
}

/**
 * Class EventService
 * Author: Dustin Spitz
 * Purpose: Calls the LocationData class to retrieve an associative array and formats this into php objects using the provided model
 */

class LocationService {

    /**
     * @return array - Returns all location as php objects
     */
    public function getAllLocationsAsPins(){
        $locationData = new LocationData();
        $pinData = $locationData->getAllLocationPinData();

        $temp = array();

        foreach($pinData as $pinArray){
            $pin = new Location(
                $pinArray['idLocation'],
                $pinArray['name'],
                $pinArray['description'],
                $pinArray['url'],
                $pinArray['longitude'],
                $pinArray['latitude'],
                $pinArray['address'],
                $pinArray['city'],
                $pinArray['state'],
                $pinArray['zipcode'],
                $pinArray['imagePath'],
                $pinArray['imageDescription'],
                $pinArray['pinDesign']
            );

            array_push($temp, $pin);
        }

        return $temp;
    }

    /**
     * @param $id - idLocation, the associated id in the database
     * @return string - Returns a JSON string that is formatted on the client side using a json parsing function
     */
    public function getLocationModalInfo($id){
        $locationData = new LocationData();
        return $locationData->getLocationModalInfo($id);
    }

    /**
     * Admin CRUD Styling
     */
    public function readLocationTable(){
        $data = $this->getAllLocationsAsPins();
        $locationTable = "
                    <h3>Locations</h3>
                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Location Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $location){
            $locationTable .= "
                      <tr>
                        <td>".$location->getName()."</td>
                        <td><button class='btn waves-effect waves-light green' type='submit' onclick='alert()'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red' type='submit' onclick='alert()'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $locationTable .= "</tbody></table>";

        return $locationTable;
    }

}

?>