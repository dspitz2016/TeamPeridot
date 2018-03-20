<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../components/Main.class.php';
include '../services/MapService.class.php';
include '../services/LocationService.class.php';

$main = Main::getInstance();
$main->getHeader();
$main->getNavigationBar();

$mapService = new MapService();
$LocationData = new LocationData();
$locationService = new LocationService();

?>

<div class="section row">
    <div class="col s10 push-s1 pull-s1">
        <div id="map"></div>
    </div>
</div>

<?php echo $locationService->getHistoricTrailDetails(); ?>

<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

        // Scavenger hunt is random pull of trackable objects
        <?php echo $mapService->initMap($locationService->getAllLocationsAsPins(),43.14082151589615, -77.62816645057916, 14, "ROADMAP", true); ?>

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

<?php $main->getScripts(); ?>

<?php $main->getFooter(); ?>

