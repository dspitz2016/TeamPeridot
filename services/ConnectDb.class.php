<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

/**
 * Class ConnectDb
 * Author: Dustin Spitz
 * Purpose: This class is responsible for establishing a connection to the database
 */

class ConnectDb
{

    private static $instance = null;
    private $conn;

    // Database Connection Information (Should be in a separate file)
    private $host = 'localhost:8889';
    private $user = 'root';
    private $pass = '';
    private $db = 'RapidsCemetery';

    /**
     * ConnectDb constructor.
     * Establish a connection to the database using PDO
     */
    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
        } catch (PDOException $e) {
            echo "Fail";
            echo $e->getMessage();
            die();
        }

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return ConnectDb|null
     * Get Instance establishes a singleton design pattern
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectDb();
        }
        return self::$instance;
    }

    /**
     * @return PDO
     * Returns established database connection
     */
    public function getConnection()
    {
        return $this->conn;
    }


    /**
     * @param $objName - Name of Object / Database Table
     * @param string $sqlString - Complete sql select statement
     * @return array - An associative array of objects pulled from the database
     */
    function returnObject($objName, $sqlString = "")
    {
        try {
            $results = array();
            if ($sqlString == "") {
                $sqlString = "SELECT * FROM " . $objName;
            }
            $stmnt = $this->conn->prepare($sqlString);
            $stmnt->execute();
            $stmnt->setFetchMode(PDO::FETCH_CLASS, $objName);
            while ($result = $stmnt->fetch()) { // or just fetchALl();
                $results[] = $result;
            }
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function deleteObject($objectID, $tableName){
        try{
            $stmt = $this->getConnection()->prepare("DELETE FROM ". $tableName . " Where id" .$tableName. " = :objectID");
            $stmt->bindParam(':objectID', $objectID, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo 'Failed to delete ' . $tableName;
            echo $e->getMessage();
            die();
        }
    }

}

?>
