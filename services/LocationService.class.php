<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/LocationData.class.php';
require_once '../models/Location.class.php';

if(isset($_GET['idLocation'])){
    $locationService = new LocationService();
    $data = $locationService->getLocationModalInfo($_GET['idLocation']);
    var_dump($data);
}

class LocationService {

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


    public function getLocationModalInfo($id){
        $locationData = new LocationData();
        return $locationData->getLocationModalInfo($id);
    }

}

?>