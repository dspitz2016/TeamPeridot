<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../components/Main.class.php';
include '../services/MapService.class.php';
include '../services/LocationService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();

$mapService = new MapService();
$LocationData = new LocationData();
$locationService = new LocationService();
?>

<div id="map"></div>

<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

        // Scavenger hunt is random pull of trackable objects
        <?php echo $mapService->initMap($locationService->getAllLocationsAsPins(),43.130016, -77.633851, 15, true); ?>

    }

</script>

<div id="modal" class="modal bottom-sheet">
    <div class="modal-content">

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Return to Map </a>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getScripts("main"); ?>

<?php $main->getFooter(); ?>

