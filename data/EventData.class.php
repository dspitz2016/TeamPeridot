<?php

include '../services/ConnectDb.class.php';

class EventData {

    function getAllEventsOrderedByDate(){
        return ConnectDb::getInstance()->returnObject("Event", "Select * From Event order by starttime desc;");
    }
}

?>