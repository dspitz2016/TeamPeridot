
<?php
    include '../services/LoginService.class.php';
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>

<h3> Get Password Validation </h3>
<?php
    $data = LoginService::getInstance()->validatePassword("dts5425@rit.edu", "pwd123");
    var_dump($data);
?>

<hr>
<br/>

</body>
</html>
