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
    
    if(isset($_POST['submit'])){
        $sql2 = "INSERT INTO products (name, price, category_id) VALUES ('" . $_POST['name'] . "','" . $_POST['price'] . "','" . $_POST['category_id'] . "')";
        if($conn->exec($sql2) != NULL){
            echo "Add Product";
            header("Location: admin2.php");
        }
    }
    

?>

<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="css/styles.css">
        </head>
        <body> 
            <div class=addproducts>
                <div>
                    <h1>Add-Products</h1>
                    <form action="" method ="post">
                        <label for="name">name:</label><br>
                        <input type="text" name="name" value=""><br>
                        <label for="price">Price:</label><br>
                        <input type="int" name="price" value=""><br>
                        <label for="category_id">Category:</label><br>
                        <input type="text" name="category_id" value=""><br>
                        <input type="submit" name="submit" value="Submit">
                    </form> 
                </div>
            </div>
        </body>
    </html>
