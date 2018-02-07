<?php
include '../services/EventService.class.php';
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>

<h3> Get Password Validation </h3>
<?php

$eventService = new EventService();

$data = $eventService->getAllEventsOrderedByDate();

var_dump($data);
?>

<hr>
<br/>

</body>
</html>
