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
        if(!self::$instance)
        {
            self::$instance = new Map();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getAllTrackableObjectPins(){
        try{
            $trackableObjectPins = array();
            $stmt = $this->conn->prepare("SELECT * FROM(
                SELECT type, longitude, latitude, concat(firstName, ' ', middleName, ' ', lastName) as name, pinColor
                FROM Grave G 
                JOIN TrackableObject T on G.idGrave = T.idGrave
                JOIN Type TF on T.idType = TF.idType
                UNION 
                SELECT type, longitude, latitude, commonName as name, pinColor
                FROM Vegetation V
                JOIN TrackableObject T on V.idVegetation = T.idVegetation
                JOIN Type TF on T.idType = TF.idType
                Union
                SELECT type, longitude, latitude, name, pinColor
                FROM OtherObject O
                JOIN TrackableObject T on O.idOtherObject = T.idOtherObject
                JOIN Type TF on T.idType = TF.idType
            ) as Pins");

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