<?php

class Event {

    public function getEventsList($eventObjects) {
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
    }
}

?>