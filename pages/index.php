<?php

    include '../components/VisitorMain.class.php';

    $main = Main::getInstance();
    $main->getHeader("main");
    $main->getNavigationBar();

    echo '<div id="map"></div>';

    $main->getScripts("main");
    $main->getFooter();
?>