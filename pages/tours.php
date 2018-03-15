<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';
include '../services/TourService.class.php';

$main = Main::getInstance();
$main->getHeader();
$main->getNavigationBar();

$tourService = new TourService();

?>

<h1>Tours Page</h1>

<h3>Available Tours</h3>

<?php
    var_dump($tourService->getAllTours());
?>

<h3>Touritems By ID</h3>


Ability to select a tour showing tour descriptions.
Ability to interact with at our item

<?php $main->getFooter(); ?>

