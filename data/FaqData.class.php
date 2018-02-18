<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../services/ConnectDb.class.php';

class FAQData {

    private static $instance = null;
    private $conn;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        try{
            $this->conn = ConnectDb::getInstance()->getConnection();
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    public static function getInstance()
    {
        echo "Login Instance <br/>";

        if(!self::$instance)
        {
            self::$instance = new LoginData();
        }
        return self::$instance;
    }

    // CREATE

    // READ
    public function getAllFAQs(){
        try{
            $faqArray = array();
            $stmt = $this->conn->prepare("SELECT idFAQ, question, answer FROM FAQ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, "FAQ.class");

            while($result = $stmt->fetch()){
                $faqArray[] = $result;
            }

            return $faqArray;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    // UPDATE

    // DELETE
}

?>