<?php

require_once '../services/ConnectDb.class.php';
include '../models/MapPin.class.php';
include 'queries.php';

Class Map
{
    private static $instance = null;
    private $conn;

    /**
     * Map constructor.
     */
    public function __construct()
    {
        echo "Map Constructor <br/>";

        try{
            $conn = ConnectDb::getInstance()->getConnection();
        }
        catch(PDOException $e){
            echo $e->getMesage();
            die();
        }
    }

    public static function getInstance()
    {
        echo "Map Instance <br/>";

        if(!self::$instance)
        {
            self::$instance = new Map();
        }
        return self::$instance;
    }

    public function getAllTrackableObjectPins(){
        echo "Map getAllObjectPins <br/>";

        try{
            $trackableObjectPins = array();
            $stmt = $this->conn->prepare("");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "MapPin");

            while($result = $stmt->fetch()){
                $trackableObjectPins[] = $result;
            }
            return $trackableObjectPins;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    } // end of get all TrackableObjectPins

}
?>