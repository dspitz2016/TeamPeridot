
<?php
    include '../services/ConnectDb.class.php';
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
        echo $account['firstName'] . " " . $account['lastName'] . "<br/>";
    }

?>
<hr>
<br/>

<h3> Get Locations </h3>
<?php
    $data = $instance->getAllLocations();
    foreach($data as $location){
        echo "Location: " . $location['name'] . "<br/>";
        echo "Latitude: " . $location['latitude'] . "<br/>";
        echo "Longitude: " . $location['longitude'] . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Event </h3>
<?php
    $data = $instance->getAllEvents();
    foreach($data as $event){
        echo "Event: " . $event['name'] . "<br/>";
        echo "Description: " . $event['description'] . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Event </h3>
<?php
    $data = $instance->getAllFAQs();
    foreach($data as $faq){
        echo "Question: " . $faq['question'] . "<br/>";
        echo "Answer: " . $faq['answer'] . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Type Filters </h3>
<?php
    $data = $instance->getAllTypeFilters();
    foreach($data as $type){
        echo "Type: " . $type['typeFilter'] . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Historic Filters </h3>
<?php
    $data = $instance->getAllTypeFilters();
    foreach($data as $historicFilter){
        echo "Historic Filter: " . $historicFilter['HistoricFilter'] . "<br/>";
    }
?>
<hr>
<br/>

<h3> Get Trackable Objects </h3>
<?php
    $data = $instance->getAllTrackableObjects();
    foreach($data as $tobj){
        echo "Name: " . $tobj['Name'] . "<br/>";
        echo "Longitude: " . $tobj['longitude'] . "<br/>";
        echo "Latitude: " . $tobj['latitude'] . "<br/>";
    }
?>
<hr>
<br/>

</body>
</html>
