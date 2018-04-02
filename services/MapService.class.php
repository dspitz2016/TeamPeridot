<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../data/MapData.class.php';
require_once '../models/MapPin.class.php';
require_once '../models/TypeFilter.class.php';
require_once '../models/HistoricFilter.class.php';
require_once '../models/Location.class.php';


/**
 * Used to generate the TrackableObject (Map Pins) modals on the wider area map
 * Passes in the Trackable Object ID and the idType to determine which query and object to return.
 */

if (isset($_GET['id']) && isset($_GET['idType'])) {
    $mapData = new MapData();
    $data = $mapData->getModalInformation($_GET['id'], $_GET['idType']);
    var_dump($data);
}

/**
 * Class MapService
 * Purpose: This service is responsible for all aspects of the Map including
 * > Initializing the map in javascript
 * > Displaying and formatting pins
 * > Setting Modals
 */
class MapService
{

    /*
     * Initialize Map Object with all the pins
     * Takes An array of Map Pin objects and calls createMapPins() to create markers
     */
    public function initMap($mapPinObjects, $mapLatitude, $mapLongitude, $mapZoom, $mapTypeId, $isLocation)
    {

        $mapInit = "
            var myLatlng = new google.maps.LatLng(" . $mapLatitude . ", " . $mapLongitude . ");
            var mapOptions = {
                zoom: " . $mapZoom . ",
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.".$mapTypeId."
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            infoWindow = new google.maps.InfoWindow;

        " . $this->createMapPins($mapPinObjects, $isLocation) . "
//                 // Try HTML5 geolocation.
if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                mark = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: \"images/pins/userMarker.png\"
                });
                var myVar = setInterval(updateUserLocation, 15000);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        //its in ms so 1000ms/second
    }
    function updateUserLocation() {
        <!-- This needs to be tested -->
        // HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                mark.setMap(null);
                mark = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: \"images/pins/userMarker.png\"
                });
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }
        
              
              function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                                      'Error: The Geolocation service failed.' :
                                      'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
              
        ";

        return $mapInit;
    }


    /**
     * getAllScavengerHuntObjectsAsPins
     * @return array - Returns an array of Trackable Objects formatted with scavengerHunt Icons
     */
    public function getAllScavengerHuntObjectsAsPins()
    {
        $mapData = new MapData();
        $pinData = $mapData->getAllTrackableObjectPinData();
        $temp = array();

        foreach ($pinData as $pinArray) {
            $pin = new MapPin(
                $pinArray['idTrackableObject'],
                $pinArray['imagePath'],
                $pinArray['longitude'],
                $pinArray['latitude'],
                $pinArray['name'],
                "https://team-peridot.ist.rit.edu/images/questionMarkPin.png",
                $pinArray['idType'],
                $pinArray['idHistoricFilter']
            );

            array_push($temp, $pin);
        }

        return $temp;
    }

    /**
     * @return array - gets all trackableObjectsAsPins from the Database and formats them into php objects
     */
    public function getAllTrackableObjectsAsPins()
    {
        $mapData = new MapData();
        $pinData = $mapData->getAllTrackableObjectPinData();

        $temp = array();

        foreach ($pinData as $pinArray) {
            $pin = new MapPin(
                $pinArray['idTrackableObject'],
                $pinArray['imagePath'],
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

    /**
     * @return array - returns an array of type filters as php objects
     */
    public function getTypeFilters()
    {
        $mapData = new MapData();
        $typeFilterData = $mapData->getAllTypeFilters();
        $allTypeFilters = array();

        foreach ($typeFilterData as $typeFilter) {
            $filterBtn = new TypeFilter(
                $typeFilter['idType'],
                $typeFilter['typeFilter'],
                $typeFilter['description'],
                $typeFilter['pinDesign'],
                $typeFilter['buttonColor']
            );

            array_push($allTypeFilters, $filterBtn);
        }

        return $allTypeFilters;
    }

    /**
     * @return array - an array of historic filters as php objects
     */
    public function getHistoricFilters()
    {
        $mapData = new MapData();
        $historicFilterData = $mapData->getAllHistoricFilters();
        $allHistoricalFilters = array();

        foreach ($historicFilterData as $historicFilter) {
            $filterBtn = new HistoricFilter(
                $historicFilter['idHistoricFilter'],
                $historicFilter['historicFilter'],
                $historicFilter['buttonColor']
            );

            array_push($allHistoricalFilters, $filterBtn);
        }

        return $allHistoricalFilters;
    }

    /**
     * @param $mapPins
     * @param $isLocation
     * @return string
     */
    public function createMapPins($mapPins, $isLocation)
    {
        $generatedMarkers = "";
        $markerCounter = 0;

        $markerName = "marker" . $markerCounter;
        $setMarkerCode = $markerName . ".setMap(map);";
        foreach ($mapPins as $pin) {
            $markerName = "marker" . $markerCounter;
            $generatedMarkers .= "var " . $markerName . " = new google.maps.Marker({
            position: {lat: " . $pin->getLatitude() . ", lng: " . $pin->getLongitude() . "},
            icon:'" . $pin->getPinDesign() . "',
            title: '" . $pin->getName() . "' ,
            idType: '" . $pin->getIdType() . "' ,
            idHistoricFilter: '" . $pin->getIdHistoricFilter() . "' ,
            map: map });
            markerAry.push(" . $markerName . ");
            ";


            $generatedMarkers .= "google.maps.event.addListener(" . $markerName . ", 'click', function(){
                $('modal').modal();
            });";


            $infoWidowConfig = $this->generateInfoWindowConfig($pin, $markerName, $isLocation);
            $generatedMarkers .= $infoWidowConfig . $setMarkerCode;
            $markerCounter += 1;
        }
        return $generatedMarkers;
    }

    /*
     * Creates a window when the pin is clicked
     */
    public function generateInfoWindowConfig($pin, $markerName, $isLocation)
    {
        $ajaxFunction = "";

        if ($isLocation) {
            $ajaxFunction = "loadLocationModal(" . $pin->getIdLocation() . ")";
        } else {
            $ajaxFunction = "loadModalContent(" . $pin->getIdTrackableObject() . "," . $pin->getIdType() . ")";
        }


        $infoWindowContent = '"' . "<div class=" . "'content center'><h5 style='margin:0;'>" . $pin->getName() .
            "</h5><br/><img height='150px' class='' src='" . $pin->getImagePath() . "' alt=''><br/>" .
            "<a class='waves-effect waves-light btn modal-trigger' href='#modal' onclick='" . $ajaxFunction . "')>See More Info</a>"
            . '</div>' . '"';

        $infoWindowGenerator = "var infowindow = new google.maps.InfoWindow();";
        $infoWindowListener = "google.maps.event.addListener(" . $markerName . ", 'click', (function(" . $markerName . ") {
            return function() {
                infoWindow.setContent(" . $infoWindowContent . ");
                infoWindow.open(map," . $markerName . ");
            }
            })(" . $markerName . "));";

        return $infoWindowGenerator . $infoWindowListener;
    }


    public function getModalInformation($id, $idType)
    {
        $mapData = new MapData();
        return $mapData->getModalInformation($id, $idType);
    }


    public function getModalId($id)
    {
        switch ($id) {
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