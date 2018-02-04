<?php

include '../data/Map.Class.php';

class MapService
{
    /**
     * MapService constructor.
     */
    public function __construct()
    {
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new MapService();
        }
        return self::$instance;
    }

    function getAllTrackableObjects()
    {
        return Map::getInstance()->getAllTrackableObjectPins();
    }

}
?>