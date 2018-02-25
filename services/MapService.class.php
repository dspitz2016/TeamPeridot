<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../data/MapData.class.php';
include '../models/MapPin.class.php';
include '../models/TypeFilter.class.php';
include '../models/HistoricFilter.class.php';


if(isset($_GET['id'])){
    $mapService = new MapService();
    $data = $mapService->getModalInformation($_GET['id']);
    var_dump($data);
}
/*
 * MapService Class
 *  > Contains Functionality to pull data for mapped objects
 *  > Collaborators : Team Garnet
 */
class MapService {

    /*
     * Initialize Map Object with all the pins
     * Takes An array of Map Pin objects and calls createMapPins() to create markers
     */
    public function initMap($mapPinObjects, $mapLatitude, $mapLongitude, $mapZoom) {

        $mapInit = "
            var myLatlng = new google.maps.LatLng(".$mapLatitude.", ".$mapLongitude.");
            var mapOptions = {
                zoom: ".$mapZoom.",
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            infoWindow = new google.maps.InfoWindow;

        ".$this->createMapPins($mapPinObjects)."
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
        return $this->addMapPinObjects($pinData);
    }

    /**
     * @return array
     * Returns an array fo TrackableObjects 
     */
    public function getAllScavengerHuntObjectsAsPins(){
        $mapData = new MapData();
        $pinData = $mapData->getAllTrackableObjectPinData();
        $temp = array();

        foreach($pinData as $pinArray){
            $pin = new MapPin(
                $pinArray['idTrackableObject'],
                $pinArray['longitude'],
                $pinArray['latitude'],
                $pinArray['name'],
    "https://cdn0.iconfinder.com/data/icons/travel-vacation/289/travel-transport-hotel-vacation-holidays-tourist-tourism-travelling-traveling_178-128.png",
                $pinArray['idType'],
                $pinArray['idHistoricFilter']
            );

            array_push($temp, $pin);
        }

        return $temp;
    }

    public function addMapPinObjects($mapPinDataAry){
        $temp = array();

        foreach($mapPinDataAry as $pinArray){
            $pin = new MapPin(
                $pinArray['idTrackableObject'],
                $pinArray['longitude'],
                $pinArray['latitude'],
                $pinArray['name'],
                $pinArray['pinDesign'],
                $pinArray['idType'],
                $pinArray['idHistoricFilter']
            );

            array_push($temp, $pin);
        }

        return $temp;
    }


    public function getTypeFilters(){
        $mapData = new MapData();
        $typeFilterData = $mapData->getAllTypeFilters();
        $allTypeFilters = array();

        foreach($typeFilterData as $typeFilter){
            $filterBtn = new TypeFilter(
                $typeFilter['idType'],
                $typeFilter['typeFilter'],
                $typeFilter['buttonColor']
            );

            array_push($allTypeFilters, $filterBtn);
        }

        return $allTypeFilters;
    }

    public function getHistoricFilters(){
        $mapData = new MapData();
        $historicFilterData = $mapData->getAllHistoricFilters();
        $allHistoricalFilters = array();

        foreach($historicFilterData as $historicFilter){
            $filterBtn = new HistoricFilter(
                $historicFilter['idHistoricFilter'],
                $historicFilter['historicFilter'],
                $historicFilter['buttonColor']
            );

            array_push($allHistoricalFilters, $filterBtn);
        }

        return $allHistoricalFilters;
    }

    /*
     * Converts the Array of MapPin Objects to HTML markers that are placed on the map
     */
    public function createMapPins($mapPins) {
        $generatedMarkers = "";
        $markerCounter = 0;

        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";
        foreach ($mapPins as $pin) {
            $idType = $pin->getIdType();



            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin->getLatitude() . ", lng: " . $pin->getLongitude() . "},
            icon:'" . $pin->getPinDesign() . "',
            title: '" . $pin->getName() . "' ,
            idType: '" . $idType . "' ,
            idHistoricFilter: '" . $pin->getIdHistoricFilter() . "' ,
            map: map });
            console.log(".$markerName.".title);
            markerAry.push(".$markerName.");
            ";


            $generatedMarkers .= "google.maps.event.addListener(" . $markerName . ", 'click', function(){
                $(".$this->getModalId($idType).").modal();
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
        $infoWindowContent = '"'."<div class=" . "'infoWindow'>". $pin->getName()."</div>". "<a class='waves-effect waves-light btn modal-trigger' href='#".$this->getModalId($pin->getIdType())."' onclick='loadModalContent(".$pin->getIdTrackableObject().")'>Modal</a>"
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


    public function getModalInformation($id){
        $mapData = new MapData();

        return $mapData->getModalInformation($id);
        //echo "Made it to the Map Service: " . $id;
    }

    public function getModalId($id){
        switch($id){
            case 0: // Grave
                return "graveModal";
                break;
            case 1:
                return "vegetationModal";
                break;
            default:
                return "otherObjectModal";
                break;
        }
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