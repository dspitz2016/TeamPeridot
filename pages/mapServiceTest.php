
<?php
include '../services/MapService.class.php';
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>

<h3> Get Map Pins </h3>
<?php

$mapService = new MapService();
$data = $mapService->getAllTrackableObjectsAsPins();

var_dump($data);


?>

<hr>
<br/>

</body>
</html>
