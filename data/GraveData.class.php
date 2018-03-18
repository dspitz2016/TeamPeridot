<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

/**
 * Class GraveData
 * Used for Grave CREATE, READ, UPDATE, DELETE QUERIES
 */
class GraveData {

    public function createGrave(){

    }

    public function readAllGraves(){
        return ConnectDb::getInstance()->returnObject("", "SELECT idTrackableObject, longitude, latitude, T.imagePath, T.imageDescription, firstName, middleName, lastName, birth, death, G.description, HF.idHistoricFilter, HF.historicFilter, T.idType, TF.typeFilter, T.idGrave, T.scavengerHuntHint, T.idLocation
                                                                            FROM Grave G 
                                                                            JOIN TrackableObject T ON G.idGrave = T.idGrave 
                                                                            JOIN Type TF ON T.idType = TF.idType 
                                                                            LEFT OUTER JOIN HistoricFilter HF ON G.idHistoricFilter = HF.idHistoricFilter");
    }

    public function updateGrave(){

    }

    public function deleteGrave(){

    }

}