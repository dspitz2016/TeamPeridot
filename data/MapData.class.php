<?php

require_once '../services/ConnectDb.class.php';

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
                SELECT idTrackableObject, T.imagePath, longitude, latitude, concat(IFNULL(firstName, ''), ' ', IFNULL(middleName,''), ' ', IFNULL(lastName,'')) as name, pinDesign, TF.idType as idType, IFNULL(hf.idHistoricFilter, \"\") as idHistoricFilter
                FROM Grave G 
                JOIN TrackableObject T on G.idGrave = T.idGrave
                LEFT OUTER JOIN HistoricFilter hf on G.idHistoricFilter = hf.idHistoricFilter
                JOIN Type TF on T.idType = TF.idType
                UNION 
                
                SELECT idTrackableObject, T.imagePath, longitude, latitude, commonName as name, pinDesign, TF.idType as idType, concat(\"\") as idHistoricFilter
                FROM Flora V
                JOIN TrackableObject T on V.idFlora = T.idFlora
                JOIN Type TF on T.idType = TF.idType
                UNION
                
                SELECT idTrackableObject, T.imagePath, longitude, latitude, name, pinDesign, TF.idType as idType, concat(\"\") as idHistoricFilter
                FROM NaturalHistory O
                JOIN TrackableObject T on O.idNaturalHistory = T.idNaturalHistory
                JOIN Type TF on T.idType = TF.idType
                
                ) as MapPin");
    }

    public function getScavengerHuntData(){

        return ConnectDb::getInstance()->returnObject("MapPin.class", "SELECT * FROM(
                SELECT idTrackableObject, longitude, latitude, concat(firstName, ' ', middleName, ' ', lastName) as name, pinDesign, TF.idType as idType, hf.idHistoricFilter as idHistoricFilter
                FROM Grave G 
                JOIN TrackableObject T on G.idGrave = T.idGrave
                JOIN HistoricFilter hf on G.idHistoricFilter = hf.idHistoricFilter
                JOIN Type TF on T.idType = TF.idType
                UNION 
                
                SELECT idTrackableObject, longitude, latitude, commonName as name, pinDesign, TF.idType as idType, concat(\"\") as idHistoricFilter
                FROM Flora V
                JOIN TrackableObject T on V.idFlora = T.idFlora
                JOIN Type TF on T.idType = TF.idType
                UNION
                
                SELECT idTrackableObject, longitude, latitude, name, pinDesign, TF.idType as idType, concat(\"\") as idHistoricFilter
                FROM NaturalHistory O
                JOIN TrackableObject T on O.idNaturalHistory = T.idNaturalHistory
                JOIN Type TF on T.idType = TF.idType
                
                ) as MapPin
                ORDER BY RAND() LIMIT 2");
    }

    public function getAllTypeFilters(){
        return ConnectDb::getInstance()->returnObject("TypeFilter.class", "SELECT idType, typeFilter, description, buttonColor FROM Type;
        ) as typeFilters");
    }

    public function getAllHistoricFilters(){
        return ConnectDb::getInstance()->returnObject("HistoricFilter.class", "SELECT idHistoricFilter, historicFilter, buttonColor FROM HistoricFilter;");
    }

    public function getModalInformation($id, $idType){
        // Grave
        if($idType == 0) {
            return json_encode(ConnectDb::getInstance()->returnObject("", "Select * from TrackableObject tobj
                Join Grave g on tobj.idGrave = g.idGrave where tobj.idTrackableObject = 
                " . $id)[0]);
        }
        else if ($idType == 1){
            return json_encode(ConnectDB::getInstance()->returnObject("", "Select * from TrackableObject tobj
Join Flora v on tobj.idFlora = v.idFlora
where tobj.idTrackableObject = ".$id)[0]);

        } else {
            return json_encode(ConnectDB::getInstance()->returnObject("", "Select * from TrackableObject tobj
Join NaturalHistory oo on tobj.idNaturalHistory = oo.idNaturalHistory
where tobj.idTrackableObject =  ".$id)[0]);

        }


    }

}
?>