<?php

    include '../components/Main.class.php';

    $main = Main::getInstance();
    $main->getHeader();
    $main->getNavigationBar();

    echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="col s3"><h2>Upcoming Events</h2></div>';
            echo '<div class="col s9"><div id="map"></div></div>';
        echo '</div>';
    echo '</div>';


$main->getScripts();
    $main->getFooter();
?>