<?php

include '../services/ConnectDb.class.php';
include '../models/MapPin.class.php';
include 'queries.php';

Class MapData
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
            $this->conn = ConnectDb::getInstance()->getConnection();
            echo "Map Conn: ";
            var_dump($this->conn);
        }
        catch(PDOException $e){
            echo $e->getMessage();
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

    public function getAllTrackableObjectPinData(){
        echo "Map getAllObjectPins <br/>";

        try{
            $trackableObjectPins = array();
            $stmt = $this->conn->prepare($trackablePinQuery);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "MapPin.class");

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