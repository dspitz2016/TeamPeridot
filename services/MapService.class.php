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
    public function initMap($pinArray) {
        $mapInit = "
                 map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 43.1293659, lng: -77.6394728},
                    zoom: 25,
                    mapTypeId: 'satellite',
                    mapTypeControl: false,
                    streetViewControl: false
                });

                map.setTilt(45);

                ".$this->createMapPins($pinArray)."
                var infoWindow = new google.maps.InfoWindow;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Location found.');
                        infoWindow.open(map);
                        map.setCenter(pos);
                        console.log(pos);
                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }
        ";

//        $mapInit = "
//            var myLatlng = new google.maps.LatLng(43.129467, -77.639153);
//            var mapOptions = {
//                zoom: 20,
//                center: myLatlng,
//                mapTypeId: google.maps.MapTypeId.HYBRID
//            };
//
//            map = new google.maps.Map(document.getElementById('map'), mapOptions);
//            infoWindow = new google.maps.InfoWindow;
//
//        ".$this->createMapPins($pinArray)."
//             if (navigator.geolocation) {
//                    navigator.geolocation.getCurrentPosition(function (position) {
//                        var pos = {
//                            lat: position.coords.latitude,
//                            lng: position.coords.longitude
//                        };
//                    }, function () {
//                        handleLocationError(true, infoWindow, map.getCenter());
//                    });
//                } else {
//                    // Browser doesn't support Geolocation
//                    handleLocationError(false, infoWindow, map.getCenter());
//                }
//            }
//            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//                infoWindow.setPosition(pos);
//                infoWindow.setContent(browserHasGeolocation ?
//                    'Error: The Geolocation service failed.' :
//                    'Error: Your browser doesn\'t support geolocation.');
//                infoWindow.open(map);
//            }
//        ";

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
            $pinColor = $this->colorHandler($pin->getPinColor());
            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin->getLatitude() . ", lng: " . $pin->getLongitude() . "},
            icon:'" . $pinColor . "',
            title: '" . $pin->getName() . "' ,
            map: map });";
//            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName);
//            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;
//            $markerCounter += 1;
        }
        return $generatedMarkers;
    }

    public function colorHandler($pinColor){
        $googleMarkerColor = "";
        switch($pinColor){
            case "red";
                $googleMarkerColor = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
                break;
            case "blue";
                $googleMarkerColor = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
                break;
            case "green";
                break;
                $googleMarkerColor = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
            case "yellow";
                break;
                $googleMarkerColor = "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
        }

        return $googleMarkerColor;
    }


}
?>