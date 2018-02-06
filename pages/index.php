<?php

    include '../components/Main.class.php';
    include '../services/MapService.class.php';

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
    $pins = $mapService->getAllTrackableObjectsAsPins();
?>

<script type="text/javascript">
    var map;
    var infoWindow;

    function initMap() {
        <?php //echo $mapService->initMap($pins); ?>
        var myLatlng = new google.maps.LatLng(43.129467, -77.639153);
        var mapOptions = {
            zoom: 20,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        infoWindow = new google.maps.InfoWindow;

        <?php $mapService->createMapPins($pins) ?> 

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
    }

</script>

    <?php $main->getScripts("main"); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

    <?php $main->getFooter(); ?>
