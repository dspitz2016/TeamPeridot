
<?php

include '../services/ConnectDb.class.php';

 try{
 $instance = ConnectDb::getInstance();
 $conn = $instance->getConnection();
 var_dump($conn);
 }
 catch(Exception $e){
 	echo $e->getMessage();
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
