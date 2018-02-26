<?php

include '../components/Main.class.php';
//include '../data/EventData.class.php';
include '../services/EventService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<h1>Events</h1>

<?php

$eventService = new EventService();

$eventObjects = $eventService->getAllEventsOrderedByDate();

// echo '<pre>' . var_export($eventObjects, true) . '</pre>';

?>

<div class="section">
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
							  <span class="card-title activator grey-text text-darken-4">Start Time:'. $event['startTime'] .'<i class="material-icons right">more_vert</i></span>
							  <span class="card-title activator grey-text text-darken-4">End Time:'. $event['endTime'] .'<i class="material-icons right">more_vert</i></span>
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

<!--
<div class="section">
<ul class="collection with-header">
<li class="collection-header center-align"><h4>Events</h4></li>
<li class="collection-item">
  <div class="row">
	  <div>
		  <div class="card">
			<div class="center-align waves-effect waves-block waves-light cust-color-seafoam">
			  <h1 class="activator">Rapids Cemetary Picnic</h1>
			</div>
			<div class="card-content">
			  <span class="card-title activator grey-text text-darken-4">5:30PM<i class="material-icons right">more_vert</i></span>
			  <p><a href="#">This is a link</a></p>
			</div>
			<div class="card-reveal">
			  <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
			  <p>Here is some more information about this product that is only revealed once clicked on.</p>
			</div>
		  </div>
	  </div>
  </div>
</li>
<li class="collection-item">
  <div class="row">
	  <div>
		  <div class="card">
			<div class="center-align waves-effect waves-block waves-light cust-color-seafoam">
			  <h1 class="activator">Kid’s History Scavenger Hunt Day</h1>
			</div>
			<div class="card-content">
			  <span class="card-title activator grey-text text-darken-4">11:45AM<i class="material-icons right">more_vert</i></span>
			  <p><a href="#">This is a link</a></p>
			</div>
			<div class="card-reveal">
			  <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
			  <p>Here is some more information about this product that is only revealed once clicked on.</p>
			</div>
		  </div>
	  </div>
  </div>
</li>
</ul>
</div>
-->

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

