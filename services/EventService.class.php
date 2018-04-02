<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../data/EventData.class.php';
require_once 'LocationService.class.php';
require_once '../models/Event.class.php';

date_default_timezone_set('America/New_York');


/**
 * Class EventService
 * Author: Dustin Spitz
 * Purpose: Calls the EventData class to retrieve an associative array and formats this into php objects using the provided model
 */
class EventService
{
    private $eventData;
    private $locationService;

    /**
     * EventService constructor.
     */
    public function __construct(){
        $this->eventData = new EventData();
        $this->locationService = new LocationService();
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
        $eventCollection = '<div class="row"><div class="col s12"><h2 class="black-text">Upcoming Events</h2></div><div class="row">';

        foreach ($data as $event){
            $singleLocation = $this->locationService->getLocationById($event->getIdLocation());

            $eventCollection .= '
					  <div class="col s12 m6 l6">
						  <div class="card">
							<div class="center-align waves-effect waves-block waves-light cust-color-rust">
							  <h3 class="activator white-text">'. $event->getName() .'</h3>
							</div>
							<div class="card-content">
							  <span class="card-title activator grey-text text-darken-4"><strong>Beings</strong> <br/>'. $event->getFormattedStartTime() . '</span>
							  <span class="card-title activator grey-text text-darken-4"><strong>Ends</strong> <br/>'. $event->getFormattedEndTime() .'</span>
							  <span class="card-title activator grey-text text-darken-4"><strong>Location</strong> <br/>'. $event->getLocationName() .'</span>
							  <span class="card-title activator grey-text text-darken-4">'. $singleLocation->getFullAddress() .'</span>

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
                   <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Events</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, eventt, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th>Location</th>
                          <th>Start Time</th>
                          <th>End Time</th>
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
                        <td>".$obj->getFormattedStartTime()."</td>
                        <td>".$obj->getFormattedEndTime()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, eventt, ".$obj->getIdEvent().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, eventt, ".$obj->getIdEvent().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table></div></div>";

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
                        </div>'

                        .$this->locationService->getEventLocationDropdown().
            
                        '<div class="row">
                            <div class="input-field col s6">
                                <label for="startDate">Event Start Date</label><br/>
                                <input id="startDate" name="startDate" type="date" required="" aria-required="true">
                            </div>
                            <div class="input-field col s6">
                                <label for="startTime">Event Start Time</label><br/>
                                <input id="startTime" name="startTime" type="time" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="input-field col s6">
                                <label for="endDate">Event End Date</label><br/>
                                <input id="endDate" name="endDate" type="date" required="" aria-required="true">
                          </div>                         
                          
                          <div class="input-field col s6">
                                <label for="endTime">Event End Time</label><br/>
                                <input id="endTime" name="endTime" type="time" required="" aria-required="true">
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
                                <label for="startDate">Event Start Date</label><br/>
                                <input id="startDate" name="startDate" type="date" required="" aria-required="true" value="'. $singleEvent->getStartDate().'">
                            </div>
                            <div class="input-field col s6">
                                <label for="startTime">Event Start Time</label><br/>
                                <input id="startTime" name="startTime" type="time" required="" aria-required="true" value="'.$singleEvent->getFormStartTime().'">
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="input-field col s6">
                                <label for="endDate">Event End Date</label><br/>
                                <input id="endDate" name="endDate" type="date" required="" aria-required="true" value="'.$singleEvent->getEndDate().'">
                          </div>                         
                          
                          <div class="input-field col s6">
                                <label for="endTime">Event End Time</label><br/>
                                <input id="endTime" name="endTime" type="time" required="" aria-required="true" value="'.$singleEvent->getFormEndTime().'">
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