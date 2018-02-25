<?php

include '../components/Main.class.php';
//include '../data/EventData.class.php';
include '../services/EventService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();
?>

<h1>Events</h1>

<?php

$eventService = new EventService();

$eventObjects = $eventService->getAllEventsOrderedByDate();

var_dump($eventObjects);

?>

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

