<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/LocationData.class.php';
require_once '../models/Location.class.php';

/**
 * Used to generate the Location modals on the wider area map
 * onclick a button sends an ajax get request providing idLocation which is used to get the information for the modal
 */
if(isset($_GET['idLocation'])){
    $locationService = new LocationService();
    $data = $locationService->getLocationModalInfo($_GET['idLocation']);
    var_dump($data);
}

/**
 * Class EventService
 * Author: Dustin Spitz
 * Purpose: Calls the LocationData class to retrieve an associative array and formats this into php objects using the provided model
 */

class LocationService {

    private $locationData;

    /**
     * LocationService constructor.
     */
    public function __construct()
    {
        $this->locationData = new LocationData();
    }


    /**
     * @return array - Returns all location as php objects
     */
    public function getAllLocationsAsPins(){
        $pinData = $this->locationData->getAllLocationPinData();

        $temp = array();

        foreach($pinData as $pinArray){
            $pin = new Location(
                $pinArray['idLocation'],
                $pinArray['name'],
                $pinArray['description'],
                $pinArray['url'],
                $pinArray['longitude'],
                $pinArray['latitude'],
                $pinArray['address'],
                $pinArray['city'],
                $pinArray['state'],
                $pinArray['zipcode'],
                $pinArray['imagePath'],
                $pinArray['imageDescription'],
                $pinArray['pinDesign'],
                $pinArray['trailOrder']
            );

            array_push($temp, $pin);
        }

        return $temp;
    }

    public function getLocationById($idLocation){
        $IdLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        $location = $this->locationData->getLocationById($idLocation);
        $singleLocation = new Location(
            $location[0]['idLocation'],
            $location[0]['name'],
            $location[0]['description'],
            $location[0]['url'],
            $location[0]['longitude'],
            $location[0]['latitude'],
            $location[0]['address'],
            $location[0]['city'],
            $location[0]['state'],
            $location[0]['zipcode'],
            $location[0]['imagePath'],
            $location[0]['imageDescription'],
            $location[0]['pinDesign'],
            $location[0]['trailOrder']
        );

        return $singleLocation;
    }
    // Create
    public function createLocation($name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder){
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_URL);
        $trailOrder = filter_var($trailOrder, FILTER_SANITIZE_NUMBER_INT);

        $this->locationData->createLocation($name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder);
    }

    // Update
    public function updateLocation($idLocation, $name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder){
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $longitude = filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $latitude = filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        $state = filter_var($state, FILTER_SANITIZE_STRING);
        $zipcode = filter_var($zipcode, FILTER_SANITIZE_STRING);
        $imagePath = filter_var($imagePath, FILTER_SANITIZE_URL);
        $imageDescription = filter_var($imageDescription, FILTER_SANITIZE_STRING);
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_URL);
        $trailOrder = filter_var($trailOrder, FILTER_SANITIZE_NUMBER_INT);

        $this->locationData->updateLocation($idLocation, $name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder);
    }

    // Delete
    public function deleteLocation($idLocation){
        $idLocation = filter_var($idLocation, FILTER_SANITIZE_NUMBER_INT);
        if($idLocation == 1){
            echo "Rapids Cemetery cannot be removed from the Database.";
        } else {
            ConnectDb::getInstance()->deleteObject($idLocation, "Location");
        }
    }

    /**
     * Get Location Detail for under the map
     */
    public function getHistoricTrailDetails(){
        $data = $this->getAllLocationsAsPins();

        $locDetailString = "<div class='row cust-color-rust'> <div class='col s12'><h3 class='white-text center'>Historic Trail Details</h3></div></div>";
        $locDetailString .= "<div class='row '>";
        $clearfix = 0;

        foreach($data as $loc){
            $locDetailString .= '<div class="col s10 push-s1 pull-s1 m10 push-m1 pull-m1 col l5 push-l1 pull-l1 historic-trail-detail">';
                $locDetailString .= '<h4>'.$loc->getName().'</h4>';
                $locDetailString .= '<p>'.$loc->getFullAddress().'</p>';
                $locDetailString .= '<p>'.$loc->getDescription().'</p>';
                $locDetailString .= '<a class="waves-effect waves-light btn" href="'.$loc->getURL().'">Go to '.$loc->getName().' Website</a>';
            $locDetailString .= '</div>';

            if($clearfix%2){
                $locDetailString .= '<div class="clearfix"></div>';
                $clearfix += 1;
            } else {
                $clearfix +=1;
            }

        }

        $locDetailString .= "</div>";

        return $locDetailString;
    }

    /**
     * @param $id - idLocation, the associated id in the database
     * @return string - Returns a JSON string that is formatted on the client side using a json parsing function
     */
    public function getLocationModalInfo($id){
        $locationData = new LocationData();
        return $locationData->getLocationModalInfo($id);
    }

    /**
     * Admin CRUD Styling
     */
    public function readLocationTable(){
        $data = $this->getAllLocationsAsPins();

        $table = "<script>
                        var loc = 'Location';
                    </script>";
        $table .= "
                    <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Locations</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, loc, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Location Name</th>
                          <th>Trail Order</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getName()."</td>
                        <td>";
                        if( $obj->getTrailOrder() > 0){
                            $table .= $obj->getTrailOrder();
                        }
                        $table .= "</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, loc, ".$obj->getIdLocation().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>";

                         if($obj->getIdLocation() != 1){
                                $table .= "<td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, loc, ".$obj->getIdLocation().")'> Delete
                                    <i class='material-icons'>delete</i>
                                </button></td>";
                         } else {
                                $table .= "<td></td>";
                         }

                      $table .= "</tr>";
        }

        $table .= "</tbody></table></div></div>";

        return $table;
    }

    public function createLocationForm(){
        return '
                        <div class="row"><div class="col s12"><h5>Create Location</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="url">Url</label>
                                <input id="url" name="url" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="longitude">longitude</label>
                                <input id="longitude" name="longitude" type="text" required="" aria-required="true">
                            </div>
                            <div class="input-field col s6">
                                <label for="latitude">latitude</label>
                                <input id="latitude" name="latitude" type="text" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="address">Address</label>  
                                <input id="address" name="address" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="city" name="city" type="text" class="validate" required="" aria-required="true">
                                <label for="city">City</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="state" name="state" maxlength="2" type="text" class="validate" required="" aria-required="true">
                                <label for="state">State</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="zipcode" name="zipcode" type="text" class="validate" required="" aria-required="true">
                                <label for="zipcode">Zip Code</label>
                            </div>
                        </div>  
               
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="imagePath" name="imagePath" type="text" class="validate" required="" aria-required="true">
                                <label for="imagePath">Image Path</label>
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="imageDescription" name="imageDescription" type="text" class="validate" required="" aria-required="true">
                                <label for="imageDescription">Image Description</label>
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="pinDesign">Pin Design</label><br/>
                                <input id="pinDesign" name="pinDesign" type="text" class="validate" required="" aria-required="true" value="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=1|FE6256|000000">
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="trailOrder" name="trailOrder" type="number" class="validate" required="" aria-required="true">
                                <label for="trailOrder">Trail Order</label>
                            </div>
                        </div>  
                         
                       '
            ;
    }

    public function updateLocationForm($idLocation){
        $singleLocation = $this->getLocationById($idLocation);

        return '
                        <div class="row"><div class="col s12"><h5>Update Location</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="name">Name</label><br/>
                                <input id="name" name="name" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getName().'">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label><br/>
                                <textarea id="description" name="description" class="materialize-textarea">'.$singleLocation->getDescription().'</textarea>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="url">Url</label><br/>                            
                                <input id="url" name="url" class="materialize-textarea" value="'.$singleLocation->getUrl().'">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="longitude">longitude</label><br/>
                                <input id="longitude" name="longitude" type="text" required="" aria-required="true" value="'.$singleLocation->getLongitude().'">
                            </div>
                            <div class="input-field col s6">
                                <label for="latitude">latitude</label><br/>
                                <input id="latitude" name="latitude" type="text" required="" aria-required="true" value="'.$singleLocation->getLatitude().'">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="address">Address</label><br/>
                                <input id="address" name="address" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getAddress().'">
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="input-field col s4">
                                <label for="city">City</label><br/>                            
                                <input id="city" name="city" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getCity().'">
                            </div>
                            <div class="input-field col s4">
                                <label for="state">State</label><br/>                            
                                <input id="state" name="state" maxlength="2" text" class="validate" required="" aria-required="true" value="'.$singleLocation->getState().'">
                            </div>
                            <div class="input-field col s4">
                                <label for="zipcode">Zip Code</label><br/>
                                <input id="zipcode" name="zipcode" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getZipcode().'">
                            </div>
                        </div>  
               
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imagePath">Image Path</label><br/>
                                <input id="imagePath" name="imagePath" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getImagePath().'">
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="imageDescription">Image Description</label><br/>
                                <input id="imageDescription" name="imageDescription" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getImageDescription().'">
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="pinDesign">Pin Design (URL)</label><br/>
                                <input id="pinDesign" name="pinDesign" type="text" class="validate" required="" aria-required="true" value="'.$singleLocation->getPinDesign().'">
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="trailOrder">Trail Order (Number)</label><br/>
                                <input id="trailOrder" name="trailOrder" type="number" class="validate" required="" aria-required="true" value="'.$singleLocation->getTrailOrder().'">
                            </div>
                        </div>  
                        
                        <div class="row" style="display:none;">
                            <div class="input-field col s12">
                                <input id="idLocation" name="idLocation" type="number" class="validate" required="" aria-required="true" value="'.$singleLocation->getIdLocation().'">
                            </div>
                        </div>  
                         
                       '

            ;
    }

    public function getLocationDropdownByObject($idLocation){
        $data = $this->getAllLocationsAsPins();
        $elem = '<div class="row">
                    <div class="input-field col s12">
                    <select name="idLocation">';
        // If the Historic filter is null set the default selected as the Choose an option
        if($idLocation == "" || $idLocation == null){
            $elem .= '<option value="0" disabled selected>Choose your option</option>';
        }

        foreach($data as $loc){
            $idLocationListValue = $loc->getIdLocation();

            // If it's not null it should match and display the field that matches
            if($idLocationListValue == 1){
                $elem .= '<option value="'.$idLocationListValue.'" selected>'.$loc->getName().'</option>';
            } else {
                $elem .= '<option value="'.$idLocationListValue.'">'.$loc->getName().'</option>';
            }
        }

        $elem .= '</select><label>Location Filter Selection</label></div></div>';

        return $elem;
    }

    public function getDefaultLocationDropdown(){
        $data = $this->getAllLocationsAsPins();
        $elem = '<div class="row">
                    <div class="input-field col s12">
                    <select name="idLocation">';


        foreach($data as $loc){
            $idLocation = $loc->getIdLocation();
            if($idLocation == 1){ // everythign belongs to rapids currently
                $elem .= '<option value="'.$idLocation.'" disabled selected>'.$loc->getName().'</option>';
            }
        }

        $elem .= '</select><label>Location Selection</label></div></div>';

        return $elem;
    }

    public function getEventLocationDropdown(){
        $data = $this->getAllLocationsAsPins();
        $elem = '<div class="row">
                    <div class="input-field col s12">
                    <select name="idLocation">';


        foreach($data as $loc){
            $idLocation = $loc->getIdLocation();
            if($idLocation == 1){ // everythign belongs to rapids currently
                $elem .= '<option value="'.$idLocation.'" disabled selected>'.$loc->getName().'</option>';
            } else {
                $elem .= '<option value="'.$idLocation.'">'.$loc->getName().'</option>';
            }
        }

        $elem .= '</select><label>Location Selection</label></div></div>';

        return $elem;
    }
}

?>