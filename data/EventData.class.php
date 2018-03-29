<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

class EventData {

    public function getAllEventsOrderedByDate(){
        return ConnectDb::getInstance()->returnObject("Event.class", "SELECT e.idEvent, e.name, e.description, e.startTime, e.endTime, e.imagePath, e.imageDescription, e.idLocation, l.name as locationName FROM Event e
INNER JOIN
Location l on e.idLocation = l.idLocation order by startTime desc;");
    }

    public function createEvent($name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO Event (name, description, startTime, endTime, imagePath, imageDescription, idLocation) 
                                                                                    VALUES (:name, :description, :startTime, :endTime, :imagePath, :imageDescription, :idLocation)");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':startTime', $startTime, PDO::PARAM_STR);
            $stmt->bindParam(':endTime', $endTime, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_INT);

            $stmt->execute();

            return ConnectDb::getInstance()->getConnection()->lastInsertId();

        }
        catch(PDOException $e){
            echo "Failed in create Event <br/>";
            echo $e->getMessage();
            die();
        }
    }

    public function updateEvent($idEvent, $name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE Event 
                                                                                   SET name = :name, 
                                                                                   description = :description, 
                                                                                   startTime = :startTime, 
                                                                                   endTime = :endTime, 
                                                                                   imagePath = :imagePath, 
                                                                                   imageDescription = :imageDescription, 
                                                                                   idLocation = :idLocation 
                                                                                   WHERE idEvent = :idEvent");

            $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':startTime', $startTime, PDO::PARAM_STR);
            $stmt->bindParam(':endTime', $endTime, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e){
            echo "Failed in update Event <br/>";
            echo $e->getMessage();
            die();
        }
    }
}

?>
