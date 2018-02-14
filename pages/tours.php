<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<h1>Tours Page</h1>

Ability to select a tour showing tour descriptions.
Ability to interact with at our item

<?php $main->getFooter(); ?>

