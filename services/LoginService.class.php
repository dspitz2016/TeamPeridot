<?php

include '../data/LoginData.class.php';

class LoginService
{
    private static $instance = null;

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new LoginService();
        }
        return self::$instance;
    }

    public function validatePassword($email, $password){
        // Sanitize
        $user = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = filter_var($password, FILTER_SANITIZE_STRING);

        echo "Validate Password Function <br/>";
        echo "User: " . $user . "<br/>";
        echo "Pass: " . $pass . "<br/>";
        $validatedResult = LoginData::getInstance()->validatePassword($user, $pass);
        echo "Is Valid? " . $validatedResult . "<br/>";
        return $validatedResult;
    }
}

?>