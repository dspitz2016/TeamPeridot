<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../services/ConnectDb.class.php';

class EventData {

    function getAllEventsOrderedByDate(){
        echo "Data get Events";
        return ConnectDb::getInstance()->returnObject("Event", "Select name, description, startTime, endTime, imagePath, imageDescription From Event order by startTime desc;");
    }
}

?>