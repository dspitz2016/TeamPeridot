<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../services/ConnectDb.class.php';

/**
 * Class GraveData
 * Used for Grave CREATE, READ, UPDATE, DELETE QUERIES
 */
class FloraData
{

    public function readAllFlora()
    {
        return ConnectDb::getInstance()->returnObject("", "SELECT idTrackableObject, longitude, latitude, T.imagePath, T.imageDescription, T.idType, TF.typeFilter, T.idGrave, T.scavengerHuntHint, T.idLocation, F.commonName, F.scientificName, F.description, F.idFlora
                                                                            FROM Flora F 
                                                                            JOIN TrackableObject T ON F.idFlora = T.idFlora 
                                                                            JOIN Type TF ON T.idType = TF.idType");
    }

    public function getFloraById($idFlora)
    {
        return ConnectDb::getInstance()->returnObject("", "SELECT idTrackableObject, longitude, latitude, T.imagePath, T.imageDescription, T.idType, TF.typeFilter, T.idGrave, T.scavengerHuntHint, T.idLocation, F.commonName, F.scientificName, F.description, F.idFlora
                                                                            FROM Flora F 
                                                                            JOIN TrackableObject T ON F.idFlora = T.idFlora 
                                                                            JOIN Type TF ON T.idType = TF.idType
                                                                            WHERE F.idFlora=" . $idFlora);
    }

    public function createFlora($commonName, $scientificName, $description)
    {
        try {
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO Flora 
                                                                                  (commonName, scientificName, description)
                                                                                  VALUES (:commonName, :scientificName, :description)");

            $stmt->bindParam(':commonName', $commonName, PDO::PARAM_STR);
            $stmt->bindParam(':scientificName', $scientificName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);

            $stmt->execute();

            return ConnectDb::getInstance()->getConnection()->lastInsertId();

        } catch (PDOException $e) {
            echo 'Failed to create Flora';
            echo $e->getMessage();
            die();
        }
    }

    public function updateFlora($idFlora, $commonName, $scientificName, $description)
    {
        try {
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE Flora
                                                                                    SET commonName = :commonName,
                                                                                        scientificName = :scientificName,
                                                                                        description = :description
                                                                                    WHERE idFlora = :idFlora");
            $stmt->bindParam(':idFlora', $idFlora, PDO::PARAM_INT);
            $stmt->bindParam(':commonName', $commonName, PDO::PARAM_STR);
            $stmt->bindParam(':scientificName', $scientificName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Failed to update flora';
            echo $e->getMessage();
            die();
        }
    }

}