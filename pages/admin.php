<?php

include '../components/Main.class.php';

$main = Main::getInstance();
?>

<h1> Admin Home Page </h1>

<?php
$main->getHeader("admin");
$main->getNavigationBar();
$main->getScripts();
$main->getFooter();

?>