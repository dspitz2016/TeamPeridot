<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once '../data/LoginData.class.php';

/**
 * Author: Dustin Spitz
 * > Sanitizes and encrypts data before it gets passed to data layer for validation
 */
class LoginService
{
    private static $instance = null;

    /**
     * @return LoginService - creates a singleton instance of the LoginService
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new LoginService();
        }
        return self::$instance;
    }

    /**
     * @param $email - User's Email
     * @param $password - User's Password -> encrypted when it gets sent to data layer
     * @return bool - returns true or false depending on if the user's password is correct
     */
    public function validatePassword($email, $password)
    {
        $user = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = filter_var($password, FILTER_SANITIZE_STRING);
        $validatedResult = LoginData::getInstance()->validatePassword($user, $pass);
        return $validatedResult;
    }
}

?>