<?php

include '../services/ConnectDb.class.php';

Class MapData{

    private static $instance = null;
    private $conn;

    /**
     * Map constructor.
     */
    public function __construct(){
        try{
            $this->conn = ConnectDb::getInstance()->getConnection();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    public static function getInstance(){
        echo "Map Instance <br/>";

        if(!self::$instance)
        {
            self::$instance = new MapData();
        }
        return self::$instance;
    }

    public function getAllTrackableObjectPinData(){
        echo "Map getAllObjectPins <br/>";

        try{
            $trackableObjectPins = array();
            $stmt = $this->conn->prepare("SELECT * FROM(
                SELECT idTrackableObject, type, longitude, latitude, concat(firstName, ' ', middleName, ' ', lastName) as name, pinColor
                FROM Grave G 
                JOIN TrackableObject T on G.idGrave = T.idGrave
                JOIN Type TF on T.idType = TF.idType
                UNION 
                SELECT idTrackableObject, type, longitude, latitude, commonName as name, pinColor
                FROM Vegetation V
                JOIN TrackableObject T on V.idVegetation = T.idVegetation
                JOIN Type TF on T.idType = TF.idType
                Union
                SELECT idTrackableObject, type, longitude, latitude, name, pinColor
                FROM OtherObject O
                JOIN TrackableObject T on O.idOtherObject = T.idOtherObject
                JOIN Type TF on T.idType = TF.idType
                ) as MapPin");
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
    }

}
?>