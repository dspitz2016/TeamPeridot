<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

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
            self::$instance = new FAQData();
        }
        return self::$instance;
    }

    // CREATE

    // READ
    public function getAllFAQs(){
        return ConnectDb::getInstance()->returnObject("FAQ.class", "Select idFAQ, question, answer FROM FAQ");
    }

    // UPDATE

    // DELETE
}

?>
