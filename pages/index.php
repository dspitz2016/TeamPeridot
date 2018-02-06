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
//    $markers = $mapService->createMapPins($pins);
?>

<script type="text/javascript">
    var map;
    function initMap() {
        <?php echo $mapService->initMap($pins); ?>
    }

</script>

    <?php $main->getScripts("main"); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

    <?php $main->getFooter(); ?>
