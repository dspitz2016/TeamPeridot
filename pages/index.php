
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

<br/>

<h3> Get Accounts </h3>
<?php
    $data = $instance->getAllAccounts();
    var_dump($data);
    echo "<br/>";
    echo "hi: " . $data[0]['firstName'];

?>

<hr>
<br/>

</body>
</html>
