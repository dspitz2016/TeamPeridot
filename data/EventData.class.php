<?php

include '../services/ConnectDb.class.php';

class EventData {

    function getAllEventsByTime(){
        return ConnectDb::getInstance()->returnObject("Event", "Select * From Event order by starttime desc;");
    }
}

?>