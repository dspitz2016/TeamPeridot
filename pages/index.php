<?php

    include '../components/Main.class.php';

    $main = Main::getInstance();
    $main->getHeader("main");
    $main->getNavigationBar();
 ?>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3>Rapids Cemetery</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div id="map"></div>
            </div>
        </div>
    </div>

<?php
    $main->getScripts("main");
    $main->getFooter();
?>