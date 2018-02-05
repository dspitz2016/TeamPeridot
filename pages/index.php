<?php

    include '../components/Main.class.php';

    $main = Main::getInstance();
    $main->getHeader();
    $main->getNavigationBar();

    echo "<h1>Hello World</h1>";

    $main->getScripts();
    $main->getFooter();
?>