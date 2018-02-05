<?php

    include '../components/Main.class.php';

    $main = Main::getInstance();
    $main->getHeader();
    $main->getNavigationBar();

    echo '<div id="map"></div>';

    $main->getScripts();
    $main->getFooter();
?>