<?php

require_once '../services/ConnectDb.class.php';

class Login {


    private static $instance = null;
    private $conn;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        echo "Login Constructor <br/>";

        try{
            $this->conn = ConnectDb::getInstance()->getConnection();
            echo "Login Conn: ";
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
            self::$instance = new Login();
        }
        return self::$instance;
    }

    public function validatePassword($email, $password)
    {
        try{
            echo "Validating Password Against DB";

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