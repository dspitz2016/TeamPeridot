<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();

$mapService = new MapService();
?>

<h1>Scavenger Hunt Page</h1>

<div id="map"></div>


<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

        <?php echo $mapService->initMap($mapService->getAllScavengerHuntObjectsAsPins()); ?>

    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

