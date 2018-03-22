<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

class FAQData {

    private static $instance = null;

    static function getInstance()
    {
        echo "Login Instance <br/>";

        if(!self::$instance)
        {
            self::$instance = new FAQData();
        }
        return self::$instance;
    }

    // CREATE
    public function createFAQ($question, $answer, $idLocation){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT into FAQ (question, answer, idLocation) VALUES (:question, :answer, :idLocation)");

            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_STR);

            $stmt->execute();
        }
        catch(PDOException $e){
            echo "Failed in create FAQ <br/>";
            echo $e->getMessage();
            die();
        }
    }

    // READ
    public function getAllFAQs(){
        return ConnectDb::getInstance()->returnObject("FAQ.class", "Select * FROM FAQ");
    }

    // UPDATE
    public function updateFAQ($idFAQ, $question, $answer, $idLocation){
        try{
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("Update FAQ
                                                                                    SET question = :question,
                                                                                        answer = :answer,
                                                                                        idLocation = :idLocation
                                                                                    WHERE idFAQ = :idFAQ");

            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_STR);
            $stmt->bindParam(':idFAQ', $idFAQ, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo "Failed to update FAQ";
            echo $e->getMessage();
            die();
        }
    }

}

?>
