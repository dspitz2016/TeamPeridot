<?php

include '../data/Map.Class.php';

class MapService
{
    private static $instance = null;

    /**
     * MapService constructor.
     */
    public function __construct()
    {
        echo "MapService Constructor<br/>";
    }

    public static function getInstance()
    {
        echo "MapService getIntance <br/>";

        if(!self::$instance)
        {
            self::$instance = new MapService();
        }
        return self::$instance;
    }

    function getAllTrackableObjectsPins()
    {
        echo "MapService getAlTrackableObjectPins() <br/>";

        return Map::getInstance()->getAllTrackableObjectPins();
    }

}
?>