<?php

    include '../components/Main.class.php';

    Main::getInstance()->getHeader();

    echo "<h1>Hello World</h1>";

    Main::getInstance()->getFooter();
?>