<?php

include '../../components/Main.class.php';

$main = Main::getInstance();

$main->getHeader("admin");
$main->getNavigationBar();
$main->getScripts();
$main->getFooter();

?>