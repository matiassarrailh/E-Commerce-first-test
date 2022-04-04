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
    
    $sql= $conn->query("select * from products where category_id = " .$_POST['category_id'].";");
    $res = $sql->fetchAll();

foreach($res as $row ){
   // if(){}
?>
<!DOCTYPE html> <!-- MAIN PAGE WHEN NO USER IS CONNECTED. A LOGIN BUTTON SHOULD REDIRECT TO A LOGIN PAGE WITH REGISTER OPTION ALSO-->
    <html>
        <head>

            <title>My E-commerce Not Logged In</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="/css/styles.css">

        </head>
        <body>
<div class = "col-3 products">
<div class = "products">
    <img src="css/images/<?php echo $row['name']?>.png"> 
    <p class = "prodDesc"><?php echo $row['name']?></p><p class ="prodDescB">$<?php echo $row['price']?></p>
    <div>
        <img src="css/images/Star - On.png" alt="">
        <img src="css/images/Star - On.png" alt="">
        <img src="css/images/Star - On.png" alt="">
        <img src="css/images/Star - On.png" alt="">
        <img src="css/images/Star.png" alt="">
    </div>
</div>
</div>
    <?php
            }?>