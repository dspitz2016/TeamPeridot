<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();

$mapService = new MapService();

?>

<h1>Wider Area Map Page</h1>

<h3>Available Tours</h3>

<?php

?>


<?php $main->getFooter(); ?>

