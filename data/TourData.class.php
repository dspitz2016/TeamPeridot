<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../services/ConnectDb.class.php';

class TourData {

    // CREATE

    // READ
    public function getAllTourData(){
        return ConnectDb::getInstance()->returnObject("Tour.class", "SELECT idTour, name, description FROM Tour");
    }

    // UPDATE

    // DELETE
}

}

?>