<?php

include '../data/Login.class.php';

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

    public function validatePassword($username, $password){
        // Sanitize
        $user = filter_var($username, FILTER_SANITIZE_STRING);
        $pass = filter_var($password, FILTER_SANITIZE_STRING);

        return Login::getInstance()-->$this->validatePassword($user, $pass);
    }
}

?>