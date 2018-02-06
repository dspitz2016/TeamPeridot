<?php

    include '../components/Main.class.php';

    $main = Main::getInstance();
    $main->getHeader("main");
    $main->getNavigationBar();
 ?>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3>Rapids Cemetery</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div id="map"></div>
            </div>
        </div>
    </div>

<?php
    $mapService = new MapService();
    $markers = $mapService->createMapPins($mapService->getAllTrackableObjectsAsPins());
?>

<script type="text/javascript">
var map;
function initMap() {
map = new google.maps.Map(document.getElementById('map'), {
center: {lat: 43.1293659, lng: -77.6394728},
zoom: 25,
mapTypeId: 'satellite',
mapTypeControl: false,
streetViewControl: false
});

map.setTilt(45);

var infoWindow = new google.maps.InfoWindow;

<?php
    echo $markers;
?>
// Try HTML5 geolocation.
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
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
infoWindow.setPosition(pos);
infoWindow.setContent(browserHasGeolocation ?
'Error: The Geolocation service failed.' :
'Error: Your browser doesn\'t support geolocation.');
infoWindow.open(map);
}

</script>

    <?php $main->getScripts("main"); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

    <?php $main->getFooter(); ?>
