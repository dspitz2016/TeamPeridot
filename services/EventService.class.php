<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

include '../data/EventData.class.php';
include '../models/Event.class.php';

/**
 * Class EventService
 * Author: Dustin Spitz
 * Purpose: Calls the EventData class to retrieve an associative array and formats this into php objects using the provided model
 */
class EventService
{

    /**
     * @return array - returns a list of php objects ordered by date
     */
    public function getAllEventsOrderedByDate()
    {

        $eventData = new EventData();
        $eventsData = $eventData->getAllEventsOrderedByDate();
        $allEvents = array();

        foreach ($eventsData as $event) {
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

        return $eventsData;
    }
}

?>