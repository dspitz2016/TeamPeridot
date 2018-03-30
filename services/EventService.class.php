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
                $event['idLocation'],
                $event['locationName']
            );

            array_push($allEvents, $newEvent);
        };

        return $allEvents;
    }

    public function getEventbyId($idEvent){
        $idEvent = filter_var($idEvent, FILTER_SANITIZE_NUMBER_INT);
        $obj = $this->eventData->getEventById($idEvent);
        $singleEvent = new Event(
            $obj[0]['idEvent'],
            $obj[0]['name'],
            $obj[0]['description'],
            $obj[0]['startTime'],
            $obj[0]['endTime'],
            $obj[0]['imagePath'],
            $obj[0]['imageDescription'],
            $obj[0]['idLocation'],
            $obj[0]['locationName']
        );

        return $singleEvent;
    }

    public function createEvent($name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation){

        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $startTime = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($startTime)));
        $endTime = filter_var (preg_replace("([^0-9/] | [^0-9-])","",htmlentities($endTime)));
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
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
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);

        $this->eventData->updateEvent($idEvent, $name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation);
    }

    public function deleteEvent($idEvent){
        $idEvent = filter_var($idEvent, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idEvent, "Event");
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

    public function readEventsTable(){
        $data = $this->getAllEventsOrderedByDate();

        $table = "<script>
                        var eventt = 'Events';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>Events</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, eventt, -1)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Location</th>
                          <th>Start Time</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getName()."</td>
                        <td>".$obj->getLocationName()."</td>
                        <td>".$obj->getStartTime()."</td>

                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, eventt, ".$obj->getIdEvent().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, eventt, ".$obj->getIdEvent().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table>";

        return $table;
    }

    public function createEventForm(){
        return '<div class="row"><div class="col s12"><h5>Create Event</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" name="name" type="text" class="validate" required="" aria-required="true">
                                <label for="name">Name</label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="startTime">Event Start</label><br/>
                                <input id="startTime" name="startTime" type="datetime-local" required="" aria-required="true">
                            </div>
                            <div class="input-field col s6">
                                <label for="endTime">Event End</label><br/>
                                <input id="endTime" name="endTime" type="datetime-local" required="" aria-required="true">
                            </div>
                        </div>
            
                      ';
    }

    public function updateEventForm($idEvent){
        $singleEvent = $this->getEventbyId($idEvent);

        return '<div class="row"><div class="col s12"><h5>Create Event</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="name">Name</label><br/>
                                <input id="name" name="name" type="text" class="validate" required="" aria-required="true" value="'.$singleEvent->getName().'">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label><br/>
                                <textarea id="description" name="description" class="materialize-textarea">'.$singleEvent->getDescription().'</textarea>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="startTime">Event Start</label><br/>
                                <input id="startTime" name="startTime" type="datetime-local" required="" aria-required="true" value="'.$singleEvent->getStartTime().'">
                            </div>
                            <div class="input-field col s6">
                                <label for="endTime">Event End</label><br/>
                                <input id="endTime" name="endTime" type="datetime-local" required="" aria-required="true" value="'.$singleEvent->getEndTime().'">
                            </div>
                        </div>
                        
                        <div class="row" style="display:none;">
                            <div class="input-field col s12">
                                <input id="idEvent" name="idEvent" type="text" class="validate" required="" aria-required="true" value="'.$singleEvent->getIdEvent().'">
                            </div>
                        </div>
            
                      ';
    }
}

?>