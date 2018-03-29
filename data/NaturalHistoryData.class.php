<?php

require_once '../services/ConnectDb.class.php';

class NaturalHistoryData {

    // CREATE
    public function createNaturalHistory($name, $description){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO NaturalHistory
                                                                                  (name, description) VALUES (:name, :description)");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();
            return ConnectDb::getInstance()->getConnection()->lastInsertId();

        }
        catch(PDOException $e){
            echo 'Failed to create natural history';
            echo $e->getMessage();
            die();
        }
    }

    // READ
    public function readAllNaturalHistory(){
        return ConnectDb::getInstance()->returnObject("", "SELECT idTrackableObject, longitude, latitude, T.imagePath, T.imageDescription, T.idType, TF.typeFilter, T.idGrave, T.scavengerHuntHint, T.idLocation, NH.idNaturalHistory, NH.name, NH.description, NH.idNaturalHistory
                                                                            FROM NaturalHistory NH 
                                                                            JOIN TrackableObject T ON T.idNaturalHistory = NH.idNaturalHistory 
                                                                            JOIN Type TF ON T.idType = TF.idType ");
    }

    public function getNaturalHistoryById($idNaturalHistory){
        return ConnectDb::getInstance()->returnObject("", "SELECT idTrackableObject, longitude, latitude, T.imagePath, T.imageDescription, T.idType, TF.typeFilter, T.idGrave, T.scavengerHuntHint, T.idLocation, NH.idNaturalHistory, NH.name, NH.description, NH.idNaturalHistory
                                                                            FROM NaturalHistory NH 
                                                                            JOIN TrackableObject T ON T.idNaturalHistory = NH.idNaturalHistory 
                                                                            JOIN Type TF ON T.idType = TF.idType 
                                                                            WHERE NH.idNaturalHistory=".$idNaturalHistory);
    }

    // Update
    public function updateNaturalHistory($idNaturalHistory, $name, $description){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE NaturalHistory
                                                                                    SET name = :name,
                                                                                    description = :description
                                                                                    WHERE idNaturalHistory = :idNaturalHistory");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':idNaturalHistory', $idNaturalHistory, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo 'Failed to update Natural History';
            echo $e->getMessage();
            die();
        }
    }

}

?>