<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<!-- Modal Trigger -->
<div class="section">
    <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>

<div id="map"></div>



<?php $main->getScripts("main"); ?>


<?php
$mapService = new MapService();
$pins = $mapService->getAllTrackableObjectsAsPins();
?>

<script type="text/javascript">

    var map, infoWindow;

    function initMap() {
        <?php echo $mapService->initMap($pins); ?>
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getFooter(); ?>
