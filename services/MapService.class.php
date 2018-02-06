<?php

include '../data/MapData.class.php';
include '../models/MapPin.class.php';

/*
 * MapService Class
 *  > Contains Functionality to pull data for mapped objects
 */
class MapService {

    /**
     * Gets all Mappable objects from the database and returns them as map pins.
     * @return array - returns array of map pins
     */
    public function getAllTrackableObjectsAsPins(){
        echo "MapService getAllTrackableObjectsAsPins() <br/>";

        $mapData = new MapData();
        $pinData = $mapData->getAllTrackableObjectPinData();
        $allMapPins = array();

        foreach($pinData as $pinArray){
            $pin = new MapPin(
                $pinArray['idTrackableObject'],
                $pinArray['type'],
                $pinArray['longitude'],
                $pinArray['latitude'],
                $pinArray['name'],
                $pinArray['pinColor']
            );

=           array_push($allMapPins, $pin);
        }

        return $allMapPins;
    }

}
?>