<?php

require_once '../services/ConnectDb.class.php';
include '../models/MapPin.class.php';
include 'queries.php';

Class Map
{

//    private $conn;
//
//    /**
//     * Map constructor.
//     */
//    public function __construct()
//    {
//        try{
//            $conn = ConnectDb::getInstance()->getConnection();
//        }
//        catch(PDOException $e){
//            echo $e->getMesage();
//            die();
//        }
//    }
//
//    public static function getInstance()
//    {
//        if(!self::$instance)
//        {
//            self::$instance = new Map();
//        }
//        return self::$instance;
//    }
//
//    public function getConnection()
//    {
//        return $this->conn;
//    }
//
//    public function getAllTrackableObjectPins(){
//        try{
//            $trackableObjectPins = array();
//            $stmt = $this->conn->prepare($this->trackableObjectPinsQry);
//            $stmt->execute();
//            $stmt->setFetchMode(PDO::FETCH_CLASS, MapPin);
//
//            while($result = $stmt->fetch()){
//                $trackableObjectPins[] = $result;
//            }
//            return $trackableObjectPins;
//        }
//        catch(PDOException $e){
//            echo $e->getMessage();
//            die();
//        }
//    } // end of get all TrackableObjectPins

}
?>