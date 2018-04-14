<?php
/**
 * Author: Dustin Spitz
 * Purpose: Clears all sessions on the page and logs user out of the admin website
 */


    ob_start();
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
?>