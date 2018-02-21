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
        if(!self::$instance)
        {
            self::$instance = new MapData();
        }
        return self::$instance;
    }

    public function getAllTrackableObjectPinData(){
        return ConnectDb::getInstance()->returnObject("MapPin.class", "SELECT * FROM(
                SELECT idTrackableObject, longitude, latitude, concat(firstName, ' ', middleName, ' ', lastName) as name, pinColor, TF.idType as idType, hf.idHistoricFilter as idHistoricFilter
                FROM Grave G 
                JOIN TrackableObject T on G.idGrave = T.idGrave
                JOIN HistoricFilter hf on G.idHistoricFilter = hf.idHistoricFilter
                JOIN Type TF on T.idType = TF.idType
                UNION 
                
                SELECT idTrackableObject, longitude, latitude, commonName as name, pinColor, TF.idType as idType, concat(\"\") as idHistoricFilter
                FROM Vegetation V
                JOIN TrackableObject T on V.idVegetation = T.idVegetation
                JOIN Type TF on T.idType = TF.idType
                UNION
                
                SELECT idTrackableObject, longitude, latitude, name, pinColor, TF.idType as idType, concat(\"\") as idHistoricFilter
                FROM OtherObject O
                JOIN TrackableObject T on O.idOtherObject = T.idOtherObject
                JOIN Type TF on T.idType = TF.idType
                
                ) as MapPin");
    }

    public function getAllTypeFilters(){
        return ConnectDb::getInstance()->returnObject("TypeFilter.class", "SELECT idType, typeFilter, buttonColor FROM Type;
        ) as typeFilters");
    }

    public function getAllHistoricFilters(){
        return ConnectDb::getInstance()->returnObject("HistoricFilter.class", "SELECT idHistoricFilter, historicFilter, buttonColor FROM HistoricFilter;");
    }



}
?>