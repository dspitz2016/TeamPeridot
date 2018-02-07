<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../data/EventData.class.php';
include '../models/Event.class.php';

class EventService {

    public function getAllEventsOrderedByDate(){
        echo "Event Service";

        $eventData = new EventData();
        $eventsData = $eventData->getAllEventsOrderedByDate();
        $allEvents = array();

            foreach($eventsData as $event){
                $newEvent = new Event(
                    $event['name'],
                    $event['description'],
                    $event['startTime'],
                    $event['endTime'],
                    $event['imagePath'],
                    $event['imageDescription']
            );

            array_push($allEvents, $newEvent);
        };

        return $allEvents;
    }
}

?>