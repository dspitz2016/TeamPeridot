<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

class TrackableObjectData {

    // CREATE
    public function createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        try{

            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO `TrackableObject` (longitude, latitude, scavengerHuntHint, imagePath, imageDescription, idLocation, idType) VALUES (:longitude, :latitude, :scavengerHuntHint, :imagePath, :imageDescription, :idLocation, :idType)");

            // Bind
            $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt->bindParam(':scavengerHuntHint', $scavengerHuntHint, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_INT);
            $stmt->bindParam(':idType', $idType, PDO::PARAM_INT);

            $stmt->execute();

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
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE TrackableObject SET id".$referenceType." = :idReferencedObject WHERE idTrackableObject = :idTrackableObject ");

            // Bind Params
            $stmt->bindParam(':idTrackableObject', $idTrackableObject, PDO::PARAM_INT);
            $stmt->bindParam(':idReferencedObject', $idReferencedObject, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    // UPDATE

    public function updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        try{
            //global $updateTrackableObjectQuery;
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE TrackableObject
SET longitude = :longitude, latitude = :latitude, scavengerHuntHint = :scavengerHuntHint, imagePath = :imagePath, imageDescription = :imageDescription, idLocation = :idLocation ,idType = :idType WHERE idTrackableObject = :idTrackableObject");

            $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt->bindParam(':scavengerHuntHint', $scavengerHuntHint, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_STR);
            $stmt->bindParam(':idType', $idType, PDO::PARAM_STR);
            $stmt->bindParam(':idTrackableObject', $idTrackableObject, PDO::PARAM_STR);

            $stmt->execute();
            return ConnectDb::getInstance()->getConnection()->lastInsertId();

        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }

    }
}

?>