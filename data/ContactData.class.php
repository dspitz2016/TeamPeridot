<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

class ContactData {

   public function readAllContacts(){
       return ConnectDb::getInstance()->returnObject("", "Select * from Contact");
   }

    public function getContactById($idContact){
        return ConnectDb::getInstance()->returnObject("", "Select * from Contact Where idContact =".$idContact);
    }

   public function createContact($firstName, $lastname, $email, $title, $description, $imagePath, $idLocation){
        try{
            $stmt= ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO Contact
                                                                                (firstName, lastName, title, email, description, imagePath, idLocation)
                                                                                VALUES
                                                                                (:firstName, :lastName, :title, :email, :description, :imagePath, :idLocation)");

            $stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":imagePath", $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(":idLocation", $idLocation, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e){
            echo "failed to create contact";
            echo $e->getMessage();
            die();
        }
   }

   public function updateContact($idContact, $firstName, $lastname, $email, $title, $description, $imagePath, $idLocation){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE Contact
                                                                                    SET firstName = :firstName,
                                                                                        lastName = :lastName,
                                                                                        title = :title,
                                                                                        email = :email,
                                                                                        description = :description,
                                                                                        idLocation = :idLocation,
                                                                                        imagePath = :imagePath
                                                                                        WHERE idContact = :idContact");

            $stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
            $stmt->bindParam(":lastName", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(":idLocation", $idLocation, PDO::PARAM_INT);
            $stmt->bindParam(":idContact", $idContact, PDO::PARAM_INT);

            $stmt->execute();
        }
        catch(PDOException $e){
            echo "failed to update contact";
            echo $e->getMessage();
            die();
        }
   }

}

?>
