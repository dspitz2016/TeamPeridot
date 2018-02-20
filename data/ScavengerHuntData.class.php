<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../services/ConnectDb.class.php';

class ScavengerHuntData {

    private static $instance = null;
    private $conn;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        try{
            $this->conn = ConnectDb::getInstance()->getConnection();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    public static function getInstance()
    {
        echo "Login Instance <br/>";

        if(!self::$instance)
        {
            self::$instance = new ScavengerHuntData();
        }
        return self::$instance;
    }

    // CREATE

    // READ
    public function getScavengerHuntData(){

        return ConnectDb::getInstance()->returnObject("FAQ.class", "SELECT * FROM(
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
                ) as MapPin
                ORDER BY RAND() LIMIT 2");
    }

    // UPDATE

    // DELETE

}

?>