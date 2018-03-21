<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../data/EventData.class.php';
require_once '../models/Event.class.php';

/**
 * Class EventService
 * Author: Dustin Spitz
 * Purpose: Calls the EventData class to retrieve an associative array and formats this into php objects using the provided model
 */
class EventService
{
    private $eventData;

    /**
     * EventService constructor.
     */
    public function __construct(){
        $this->eventData = new EventData();
    }


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
                $event['idEvent'],
                $event['name'],
                $event['description'],
                $event['startTime'],
                $event['endTime'],
                $event['imagePath'],
                $event['imageDescription'],
                $event['idLocation']
            );

            array_push($allEvents, $newEvent);
        };

        return $allEvents;
    }

    public function createEvent($name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation){

        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $startTime = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($startTime)));
        $endTime = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($endTime)));
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_STRING);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);


        $this->eventData->createEvent($name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation);
    }

    public function updateEvent($idEvent, $name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation){

        $idEvent = filter_var($idEvent, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $startTime = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($startTime)));
        $endTime = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($endTime)));
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_STRING);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->eventData->updateEvent($idEvent, $name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation);
    }

    public function deleteEvent($idEvent){
        $idEvent = filter_var($idEvent, FILTER_SANITIZE_NUMBER_INT);
        $this->eventData->deleteEvent($idEvent);
    }

    /**
     * HTML Components
     */

    public function getAllStyledHTMLEvents(){
        $data = $this->getAllEventsOrderedByDate();
        $eventCollection = '<div class="row cust-color-seafoam"><div class="col s12"><h2 class="white-text">Upcoming Events</h2></div><div class="row">';

        foreach ($data as $event){
            $eventCollection .= '
					  <div class="col s4">
						  <div class="card">
							<div class="center-align waves-effect waves-block waves-light cust-color-rust">
							  <h3 class="activator white-text">'. $event->getName() .'<i class="material-icons right">more_vert</i></h3>
							</div>
							<div class="card-content">
							  <span class="card-title activator grey-text text-darken-4"><strong>Beings</strong> <br/>'. $event->getStartTime() . '</span>
							  <span class="card-title activator grey-text text-darken-4"><strong>Ends</strong> <br/>'. $event->getEndTime() .'</span>
							</div>
							<div class="card-reveal">
							  <span class="card-title grey-text text-darken-4">Event Description<i class="material-icons right">close</i></span>
							  <p>'. $event->getDescription() .'</p>
							</div>
						  </div>
					  </div>';
        }

        $eventCollection .= "</div></div>";

        return $eventCollection;
    }

}

?>