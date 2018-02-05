<?php

    include '../components/Main.class.php';

    $main = Main::getInstance();
    $main->getHeader();
    $main->getNavigationBar();

    echo '<div class="container">';
        echo '<div class="row">';
            echo '<div id="map"></div>';
        echo '</div>';
    echo '</div>';


$main->getScripts();
    $main->getFooter();
?>