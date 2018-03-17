<?php

require_once '../services/ConnectDb.class.php';

class LocationData {

    public function getAllLocationPinData(){
        return ConnectDb::getInstance()->returnObject("Location.class", "Select * from Location");
    }

    public function getLocationModalInfo($id){
        return json_encode(ConnectDb::getInstance()->returnObject("Location.class", "Select * from Location where idLocation = ".$id)[0]);
    }

}

?>