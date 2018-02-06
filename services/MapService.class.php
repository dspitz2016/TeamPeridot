<?php

include '../data/MapData.class.php';
include '../models/MapPin.class.php';

/*
 * MapService Class
 *  > Contains Functionality to pull data for mapped objects
 */
class MapService {

    /*
     * Initialize Map Object
     */
    public function initMap() {
        $mapInit = "        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 43.1293659, lng: -77.6394728},
            zoom: 25,
            mapTypeId: 'satellite',
            mapTypeControl: false,
            streetViewControl: false
        });
        
        map.setTilt(45);
        var infoWindow = new google.maps.InfoWindow;";
        return $mapInit;
    }

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

           array_push($allMapPins, $pin);
        }

        return $allMapPins;
    }


    public function createMapPins($pinObjectsArray) {
        $generatedMarkers = "";
        $markerCounter = 0;
        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";
        foreach ($pinObjectsArray as $pin) {
            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin -> getLongitude() . ", lng: " . $pin -> getLongitude() . "},
            icon:'{ path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW, strokeColor:" . $pin -> getPinColor() . "}',
           
            title: '" . $pin -> getName() . "' ,
            map: map });";
            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName);
            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;
            $markerCounter += 1;
        }
        return $generatedMarkers;
    }


}
?>