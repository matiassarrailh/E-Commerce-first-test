<?php
   session_start();
   //CONNECTING TO THE DATABASE
   
   $host = "localhost";
   $port = 8080;
   $user = "admin";
   $pass = "admin";
   $dbname = "my_shop";
   
   // TRY TO CONNECT
   
   try {
       $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   
   // SAVE ERROR IF CONNECTION FAILED
   
   catch (PDOException $e){
       echo "PDO ERROR: " . $e->getMessage() . " storage in error.log.\n";
       $myerr =  "PDO ERROR: " . $e->getMessage() . " storage in error.log\n";
       file_put_contents("error.log", $myerr, FILE_APPEND);
    }

if(isset($_GET['delete'])){
    $sql3="DELETE FROM products WHERE name = '" . $_GET['delete'] . "';";
    if($conn->exec($sql3)){
        echo " PRODUCT DELETED";
        header("Location: admin2.php");
    }
}