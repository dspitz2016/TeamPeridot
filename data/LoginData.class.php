<?php

include '../services/ConnectDb.class.php';

class LoginData {

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
            self::$instance = new LoginData();
        }
        return self::$instance;
    }

    public function validatePassword($email, $password)
    {
        try{
            $userPassword = null;
            $stmt = $this->conn->prepare("SELECT password FROM Account WHERE email = :email");
            $stmt->execute(array(":email"=>$email));

            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user !== false){

                if(sha1($password) == $user['password']){
                    return true;
                } else {
                    return false;
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

}

?>