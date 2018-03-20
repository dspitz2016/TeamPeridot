<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

class AdminTrackableObjectData {

    // CREATE
    public function createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        try{

            $stmnt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO `TrackableObject` (longitude, latitude, scavengerHuntHint, imagePath, imageDescription, idLocation, idType) VALUES (:longitude, :latitude, :scavengerHuntHint, :imagePath, :imageDescription, :idLocation, :idType)");

            // Bind
            $stmnt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmnt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmnt->bindParam(':scavengerHuntHint', $scavengerHuntHint, PDO::PARAM_STR);
            $stmnt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmnt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmnt->bindParam(':idLocation', $idLocation, PDO::PARAM_INT);
            $stmnt->bindParam(':idType', $idType, PDO::PARAM_INT);

            $stmnt->execute();

            return ConnectDb::getInstance()->getConnection()->lastInsertId();

        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    // UPDATE GRAVE, FLORA, NATURALHISTORY ID
    public function updateReferencedTrackableObject($idTrackableObject, $idReferencedObject, $referenceType){
        try{
            $stmnt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE TrackableObject SET id".$referenceType." = :idReferencedObject WHERE idTrackableObject = :idTrackableObject ");

            // Bind Params
            $stmnt->bindParam(':idTrackableObject', $idTrackableObject, PDO::PARAM_INT);
            $stmnt->bindParam(':idReferencedObject', $idReferencedObject, PDO::PARAM_INT);

            $stmnt->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    // UPDATE

    public function updateTrackableObject(){

    }

    // DELETE
    public function deleteTrackableObject(){

    }
}

?>