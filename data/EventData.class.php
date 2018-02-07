<?php

include '../services/ConnectDb.class.php';

class EventData {

    function getAllEventsOrderedByDate(){
        return ConnectDb::getInstance()->returnObject("", "Select name, description, startTime, endTime, imagePath, imageDescription From Event order by startTime desc;");
    }
}

?>