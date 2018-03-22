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

    private $locationData;

    /**
     * LocationService constructor.
     */
    public function __construct()
    {
        $this->locationData = new LocationData();
    }


    /**
     * @return array - Returns all location as php objects
     */
    public function getAllLocationsAsPins(){
        $pinData = $this->locationData->getAllLocationPinData();

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
                $pinArray['pinDesign'],
                $pinArray['trailOrder']
            );

            array_push($temp, $pin);
        }

        return $temp;
    }

    // Create
    public function createLocation($name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder){
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_URL);
        $trailOrder = filter_var($trailOrder, FILTER_SANITIZE_NUMBER_INT);

        $this->locationData->createLocation($name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder);
    }

    // Update
    public function updateLocation($idLocation, $name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder){
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_URL);
        $trailOrder = filter_var($trailOrder, FILTER_SANITIZE_NUMBER_INT);

        $this->locationData->updateLocation($idLocation, $name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder);
    }

    // Delete
    public function deleteLocation($idLocation){
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idLocation, "Location");
    }

    /**
     * Get Location Detail for under the map
     */
    public function getHistoricTrailDetails(){
        $data = $this->getAllLocationsAsPins();

        $locDetailString = "<div class='row '>";
        $clearfix = 0;

        foreach($data as $loc){
            $locDetailString .= '<div class="col s10 push-s1 pull-s1 m5 push-m1 pull-m1 col l5 push-l1 pull-l1">';
                $locDetailString .= '<h5>'.$loc->getTrailOrder().') '.$loc->getName().'</h5>';
                $locDetailString .= '<p>'.$loc->getDescription().'</p>';
                $locDetailString .= '<a href="'.$loc->getURL().'">Link to: '.$loc->getName().'</a>';
            $locDetailString .= '</div>';

            if($clearfix%2){
                $locDetailString .= '<div class="clearfix"></div>';
                $clearfix += 1;
            } else {
                $clearfix +=1;
            }

        }

        $locDetailString .= "</div>";

        return $locDetailString;
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