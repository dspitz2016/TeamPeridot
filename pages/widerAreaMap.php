<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();

$mapService = new MapService();

?>

<h1>Wider Area Map Page</h1>

<div id="map"></div>

<?php
    $mapData = new MapData();
    $data = $mapService->getWiderAreaMapAsPins();
    var_dump($data);

?>

<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

        // Scavenger hunt is random pull of trackable objects
        <?php echo $mapService->initMap($mapService->getWiderAreaMapAsPins(),43.129467, -77.639153, 20); ?>


    }

</script>

<div id="otherObjectModal" class="modal bottom-sheet">
    <div class="modal-content">
        <h4 id="otherObjectName">Other</h4>
        <p id="otherObjectDescription">I tried</p>

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getScripts("main"); ?>

<?php $main->getFooter(); ?>

