<?php

    include '../components/Main.class.php';
    include '../services/MapService.class.php';

    $main = Main::getInstance();
    $main->getHeader();
    $main->getNavigationBar();
 ?>
	
    <div class="parallax-container">
      <div class="parallax"><img src="https://i.imgur.com/rG4MHt1.jpg"></div>
    </div>	
	
	<div class="section cust-color-mint">
		<div class="row container">
		  <h2 class="header">Rapids Cemetary</h2>
		  <p class="grey-text text-darken-3 lighten-3">
			A place where legends never die.
		  </p>
		</div>
	</div>
	
	<div id="map"></div>
	
    <div class="parallax-container">
      <div class="parallax"><img src="https://i.imgur.com/crngNCl.jpg"></div>
    </div>
 
	<div id="map"></div>

<?php
$mapService = new MapService();
?>

<script type="text/javascript">

    var map, infoWindow;

    var markerAry = [];

    function initMap() {
        <?php echo $mapService->initMap($pins); ?>
    }

</script>

<?php $main->getScripts(); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getFooter(); ?>
