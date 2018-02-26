<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';
include '../components/FilterBar.class.php';

include '../services/EventService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();

$mapService = new MapService();

?>


<div class="parallax-container">
    <div class="parallax"><img src="https://www.gannett-cdn.com/-mm-/f924d923a0260fd170c12b5a1c21c61aa1590bc4/c=0-222-2163-1444&r=x803&c=1600x800/local/-/media/2015/11/10/Rochester/Rochester/635827519552760428-TY-110815-RAPIDS-CEMETERY-I.JPG"></div>
</div>


<div class="section cust-color-white">

    <div class="row container">
        <h3 class="header">Welcome to Rapids Cemetery!</h3>
        <p class="grey-text text-darken-3 lighten-3">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras condimentum rhoncus iaculis. Etiam blandit venenatis nibh et consequat. In pretium sem id est tempor, vitae mattis tortor condimentum. Suspendisse potenti. Nullam sed eros aliquet, dictum nibh id, egestas quam. Nulla fringilla laoreet luctus. Aliquam vel maximus turpis, lacinia gravida nunc. Quisque pretium dictum nibh et euismod. Praesent aliquam lorem ut consequat tristique. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc nec enim iaculis leo tristique finibus. Phasellus pellentesque justo a porttitor fringilla.

            <br/><br/>
            19th Ward Community Association --- 216 Thurston Road Rochester, NY 14619 --- Phone: (585) 328-6571 ---- 19thWard@19wca.org
        </p>
    </div>

</div>


<div class="section cust-color-rust">
    <div class="row container white-text">

        <div class="col s4 center-align">
            <h5>Tours</h5>
            <i class="large material-icons">map</i>
            <p class="center-align">
                Learn about the cemetery through interactive tours.
            </p>
        </div>
        <div class="col s4 center-align">
            <h5>Scavenger Hunts</h5>
            <i class="large material-icons">search</i>
            <p class="center-align">
                Test your knowledge and try to find things on your own.
            </p>
        </div>
        <div class="col s4 center-align">
            <h5>Schedule Events!</h5>
            <i class="large material-icons">schedule</i>
            <p class="center-align">
                Schedule an event with us.
            </p>
        </div>

    </div>
</div>

<?php
	$eventService = new EventService();
	$eventObjects = $eventService->getAllEventsOrderedByDate();
?>

<div class="section cust-color-mint">
<ul class="collection with-header">
<li class="collection-header center-align"><h4>Events</h4></li>
<?php
	foreach($eventObjects as $event){
		echo '<li class="collection-item">
				  <div class="row">
					  <div>
						  <div class="card">
							<div class="center-align waves-effect waves-block waves-light cust-color-seafoam">
							  <h1 class="activator">'. $event['name'] .'</h1>
							</div>
							<div class="card-content">
							  <span class="card-title activator grey-text text-darken-4">Begins: '. $event['startTime'] .'<i class="material-icons right">more_vert</i></span>
							  <span class="card-title activator grey-text text-darken-4">Ends: '. $event['endTime'] .'<i class="material-icons right">more_vert</i></span>
							</div>
							<div class="card-reveal">
							  <span class="card-title grey-text text-darken-4">Event Description<i class="material-icons right">close</i></span>
							  <p>'. $event['description'] .'</p>
							</div>
						  </div>
					  </div>
				  </div>
				</li>';
	}
?>
</ul>
</div>

<?php
    $filterBar = new FilterBar();
    $filterBar->getTypeFilterBar($mapService->getTypeFilters());
    $filterBar->getHistoricFilterBar($mapService->getHistoricFilters());
?>

<div id="map"></div>


<div class="section cust-color-rust">
    <div class="row container white-text">
        <div class="col s12">
            Footer placeholder
        </div>

    </div>
</div>

<div id="modal" class="modal bottom-sheet">
    <div class="modal-content">

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Return to Map </a>
    </div>
</div>

<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

    <?php echo $mapService->initMap($mapService->getAllTrackableObjectsAsPins(), 43.129467, -77.639153, 20, false); ?>

    }

</script>

<?php $main->getScripts("main"); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getFooter(); ?>
