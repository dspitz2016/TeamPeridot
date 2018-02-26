<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

//include '../services/ConnectDb.class.php'; // if adding an events page keep otherwise delete if putting in index

class EventData {

    function getAllEventsOrderedByDate(){
        return ConnectDb::getInstance()->returnObject("Even.class", "Select name, description, startTime, endTime, imagePath, imageDescription From Event order by startTime desc;");
    }
}

?>
