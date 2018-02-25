<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<h1>Contact Page</h1>
Simple contact page, must be tested for sending email



<?php $main->getFooter(); ?>

