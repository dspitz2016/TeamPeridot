<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../data/MapData.class.php';
include '../models/MapPin.class.php';

/*
 * MapService Class
 *  > Contains Functionality to pull data for mapped objects
 *  > Collaborators : Team Garnet
 */
class MapService {

    public $mapPins;

    /**
     * MapService constructor.
     * initializes an array of Map Pins to be manipulated by the service.
     */
    public function __construct()
    {
        $this->mapPins = $this->getAllTrackableObjectsAsPins();
    }

    /*
     * Initialize Map Object with all the pins
     */
    public function initMap() {

        $mapInit = "
            var myLatlng = new google.maps.LatLng(43.129467, -77.639153);
            var mapOptions = {
                zoom: 20,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            infoWindow = new google.maps.InfoWindow;

        ".$this->createMapPins()."
             if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                    }, function () {
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

        return $mapInit;
    }

    /**
     * Gets all Mappable objects from the database and returns them as map pins.
     * @return array - returns array of map pins
     */
    public function getAllTrackableObjectsAsPins(){
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


    /*
     * Converts the Array of MapPin Objects to HTML markers that are placed on the map
     */
    public function createMapPins() {
        $generatedMarkers = "";
        $markerCounter = 0;
        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";
        foreach ($this->mapPins as $pin) {
            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin->getLatitude() . ", lng: " . $pin->getLongitude() . "},
            icon:'" . $pin->getPinColor() . "',
            title: '" . $pin->getName() . "' ,
            map: map });";

            $generatedMarkers .= "google.maps.event.addListener(".$markerName.", 'click', function(){
                $('#modal').modal();
            });";
            $infoWidowConfig = $this -> generateInfoWindowConfig($pin, $markerName);
            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;
            $markerCounter += 1;
        }
        return $generatedMarkers;
    }

    /*
     * Creates a window when the pin is clicked
     */
    public function generateInfoWindowConfig($pin, $markerName) {
        $infoWindowContent = '"'."<div class=" . "'infoWindow'>". $pin->getName()."</div>". "<a class='waves-effect waves-light btn modal-trigger' href='#modal1'>Modal</a>"
.'"';

        $infoWindowGenerator = "var infowindow = new google.maps.InfoWindow();";
        $infoWindowListener = "google.maps.event.addListener(" . $markerName . ", 'click', (function(" . $markerName . ") {
            return function() {
                infoWindow.setContent(" . $infoWindowContent . ");
                infoWindow.open(map," . $markerName . ");
            }
            })(" . $markerName . "));";
        return $infoWindowGenerator . $infoWindowListener;
    }


    /**
     * @return mixed
     */
    public function getMapPins()
    {
        return $this->mapPins;
    }

    /**
     * @param mixed $mapPins
     */
    public function setMapPins($mapPins)
    {
        $this->mapPins = $mapPins;
    }

}
?>