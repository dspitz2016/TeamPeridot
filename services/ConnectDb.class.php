<?php

// Singleton to connect db.
class ConnectDb {
  // Hold the class instance.
  private static $instance = null;
  private $conn;

  private $host = 'localhost:3306';
  private $user = 'root';
  private $pass = 'Ch33zeB@llFestival!!;
  private $db = 'RapidsCemetery';
   
  // The db connection is established in the private constructor.
  private function __construct()
  {
    // echo "construct";
    // $this->conn = new PDO("mysql:host={$this->host};
    // dbname={$this->name}", $this->user,$this->pass,
    // array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

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
    echo "get instance";

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
            echo "<br/> return objects";
            $results = array();
            if($sqlString == "") {
                echo "<br/> string empty";
                $sqlString = "SELECT * FROM " .$objName;
            }
            echo "<br> " . $sqlString;
            $stmnt = $this->conn->prepare($sqlString);
            $stmnt->execute();
            $stmnt->setFetchMode(PDO::FETCH_CLASS,$objName);
            while($result = $stmnt->fetch()){ // or just fetchALl();
                $results[] = $result;
            }
            return $results;
        }
        catch(PDOException $e){
            echo "fail";
            echo $e->getMessage();
            die();
        }
    }

    function getAllAccounts(){
        echo "<br/> Accounts called";
        return $this->returnObject("Account", "");
    }
}

?>