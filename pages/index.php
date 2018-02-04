
<?php
    include '../services/ConnectDb.class.php';
    include '../services/MapService.class.php';
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>

<h3>Test Connection</h3>

<?php
    try{
        $instance = ConnectDb::getInstance();
        $conn = $instance->getConnection();
        var_dump($conn);
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
?>

<hr>

<h3> Get Account </h3>
<?php
    $data = $instance->getAllAccounts();
    foreach($data as $account){
        echo $account->getFirstName() . " " . $account->getLastName();

    }

?>
<hr>
<br/>

<h3> Get Locations </h3>
<?php
    $data = $instance->getAllLocations();
    foreach($data as $location){
        echo "Location: " . $location->getName() . "<br/>";
        echo "Latitude: " . $location->getLatitude() . "<br/>";
        echo "Longitude: " . $location->getLongitude() . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Event </h3>
<?php
    $data = $instance->getAllEvents();
    foreach($data as $event){
        echo "Event: " . $event->getName() . "<br/>";
        echo "Description: " . $event->getDescription() . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get FAQ </h3>
<?php
    $data = $instance->getAllFAQs();
    foreach($data as $faq){
        echo "Question: " . $faq->getQuestion() . "<br/>";
        echo "Answer: " . $faq->getAnswer() . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Type Filters </h3>
<?php
    $data = $instance->getAllTypeFilters();
    foreach($data as $type){
        echo "Type: " . $type->getTypeFilter() . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Historic Filters </h3>
<?php
    $data = $instance->getAllHistoricFilters();
    foreach($data as $historicFilter){
        echo "Historic Filter: " . $historicFilter->getDescription() . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Trackable Pins </h3>
<?php
    $data = $instance->getAllTrackableObjects();
    foreach($data as $tobj){
        echo "Longitude: " . $tobj->getLongitude() . "<br/>";
        echo "Latitude: " . $tobj->getLatitude() . "<br/>";
        echo "Scavenger Hunt Hint: " . $tobj->getScavengerHuntHint() . "<br/>";
    }
    $data = MapService::getInstance()->getAllTrackableObjects();
    foreach($data as $pin){
        echo "Longitude: " . $pin->getLogitude(); . "<br/>";
        echo "Latitude: " . $pin->getLatitude() . "<br/>";
        echo "Scavenger Hunt Hint: " . $pin->getScavengerHuntHint() . "<br/>";
    }
?>
<hr>
<br/>

</body>
</html>
