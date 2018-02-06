<?php

include '../data/Map.class.php';

class MapService
{

    function getAllTrackableObjectsPins()
    {
        echo "MapService getAlTrackableObjectPins() <br/>";

        return Map::getInstance()->getAllTrackableObjectPins();
    }

}
?>