<?php

include '../models/includeAllObjects.php';


class ConnectDb {
  private static $instance = null;
  private $conn;

  private $host = 'localhost:3306';
  private $user = 'root';
  private $pass = 'Ch33zeB@llFestival!!';
  private $db = 'RapidsCemetery';

  private function __construct()
  {
    try{
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}",$this->user,$this->pass);
    }
    catch(PDOException $e){
        echo "Fail";
        echo $e->getMessage();
        die();
    }

    $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }

  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDb();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }

    /*
   * Takes a table name, and optional sql string
   * Prepares and executes the statement
   * @param $objName
   * @param $sqlString
   * @return: $results
   */
    function returnObject($objName, $sqlString=""){
        try{
            $results = array();
            if($sqlString == "") {
                $sqlString = "SELECT * FROM " .$objName;
            }
            $stmnt = $this->conn->prepare($sqlString);
            $stmnt->execute();
            $stmnt->setFetchMode(PDO::FETCH_CLASS,$objName);
            while($result = $stmnt->fetch()){ // or just fetchALl();
                $results[] = $result;
            }
            return $results;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    function getAllAccounts(){
        return $this->returnObject("Account", "");
    }

    function getAllEvents(){
        return $this->returnObject("Event", "");
    }

    function getAllFAQs(){
        return $this->returnObject("FAQ", "");
    }

    function getAllLocations(){
        return $this->returnObject("Location", "");
    }

    function getAllTypeFilters(){
        return $this->returnObject("TypeFilter", "");
    }

    function getAllTrackableObjects(){
        return $this->returnObject("TrackableObject", "");
    }
}

?>
