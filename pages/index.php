
<?php

include '../services/ConnectDb.class.php';

 try{

 echo "beginning <br/>";
 $instance = ConnectDb::getInstance();
 $conn = $instance->getConnection();
 var_dump($conn);
 echo "<br/> end";

 }
 catch(Exception $e){
 	echo $e->getMessage();
 }

echo "<br/> hi";
$data = $instance->getAllAccounts();

echo "<br/> hi2 <br/>";

var_dump($data);
echo "<br/>";
echo "hi: " . $data[0]['firstName'];


foreach($data as $acct){
    echo "made it";
    $fname = $acct->firstName;
    echo $fname;
}
?>

<html>
 <head>
  <title>PHP Test</title>
 </head>

 <body>

 <?php echo '<p>Hello World</p>'; ?> 

 </body>
</html>