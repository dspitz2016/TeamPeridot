<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

include '../data/LoginData.class.php';

/**
 * Used to generate the Location modals on the wider area map
 * onclick a button sends an ajax get request providing idLocation which is used to get the information for the modal
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