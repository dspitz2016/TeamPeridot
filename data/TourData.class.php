<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

include '../services/ConnectDb.class.php';

class TourData {

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
            self::$instance = new TourData();
        }
        return self::$instance;
    }

    // CREATE

    // READ
    public function getAllTourData(){
        return ConnectDb::getInstance()->returnObject("Tour.class", "SELECT idTour, name, description FROM Tour");
    }

    // UPDATE

    // DELETE
}

}

?>