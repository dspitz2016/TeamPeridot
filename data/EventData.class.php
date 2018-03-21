<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

//include '../services/ConnectDb.class.php'; // if adding an events page keep otherwise delete if putting in index

class EventData {

    public function getAllEventsOrderedByDate(){
        return ConnectDb::getInstance()->returnObject("Even.class", "Select name, description, startTime, endTime, imagePath, imageDescription From Event order by startTime desc;");
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

    public function deleteEvent($idEvent){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("DELETE FROM Event WHERE idEvent= :idEvent");
            $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo "Failed in delete Event <br/>";
            echo $e->getMessage();
            die();
        }
    }
}

?>
