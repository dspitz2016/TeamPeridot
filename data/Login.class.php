<?php

require_once '../services/ConnectDb.class.php';

class Login {


    private $conn;

    /**
     * Map constructor.
     */
    public function __construct()
    {
        echo "Login Constructor <br/>";

        try{
            $this->conn = ConnectDb::getInstance()->getConnection();
            echo "Login Conn: ";
        }
        catch(PDOException $e){
            echo $e->getMesage();
            die();
        }
    }

    public static function getInstance()
    {
        echo "Login Instance <br/>";

        if(!self::$instance)
        {
            self::$instance = new Map();
        }
        return self::$instance;
    }

    public function validatePassword($email, $password)
    {
        try{
            $userPassword = null;
            $stmt = $this->conn->prepare("SELECT password FROM Account WHERE email = :email");
            $stmt->execute(array(":email"=>$email));
            while ($row = $stmt->fetch())
            {
                $userPassword = $row;
            }
            echo $userPassword[0] . "<br/>";
            if($userPassword[0] == $password){
                return true;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

}

?>