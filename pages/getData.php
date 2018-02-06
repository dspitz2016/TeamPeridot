
<?php
    include '../services/ConnectDb.class.php';
    include '../services/MapService.class.php';
    include '../services/LoginService.class.php';
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
<!---->
<!--<h3> Get Account </h3>-->
<?php
//    $data = $instance->getAllAccounts();
//    foreach($data as $account){
//        echo $account->getFirstName() . " " . $account->getLastName() . "<br/>";
//    }
//
//?>
<!--<hr>-->
<!--<br/>-->
<!---->
<!--<h3> Get Locations </h3>-->
<?php
//    $data = $instance->getAllLocations();
//    foreach($data as $location){
//        echo "Location: " . $location->getName() . "<br/>";
//        echo "Latitude: " . $location->getLatitude() . "<br/>";
//        echo "Longitude: " . $location->getLongitude() . "<br/>";
//    }
//?>
<!--<hr>-->
<!--<br/>-->
<!---->
<!--<h3> Get Event </h3>-->
<?php
//    $data = $instance->getAllEvents();
//    foreach($data as $event){
//        echo "Event: " . $event->getName() . "<br/>";
//        echo "Description: " . $event->getDescription() . "<br/>";
//    }
//?>
<!--<hr>-->
<!--<br/>-->
<!---->
<!--<h3> Get FAQ </h3>-->
<?php
//    $data = $instance->getAllFAQs();
//    foreach($data as $faq){
//        echo "Question: " . $faq->getQuestion() . "<br/>";
//        echo "Answer: " . $faq->getAnswer() . "<br/>";
//    }
//?>
<!--<hr>-->
<!--<br/>-->
<!---->
<!--<h3> Get Trackable Pins </h3>-->
<?php
//    $mapService = new MapService();
//    $pins = $mapService->getAllTrackableObjectsAsPins();
//    var_dump($pins);
//?>
<!---->
<!--<hr>-->
<!--<br/>-->
<!---->
<!--<h3> Get Password Validation </h3>-->
<?php
//    $data = LoginService::getInstance()->validatePassword("dts5425@rit.edu", "pwd123");
//    var_dump($data);
//?>
<!---->
<!--<hr>-->
<!--<br/>-->

</body>
</html>
