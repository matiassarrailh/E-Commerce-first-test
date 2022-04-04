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

   $display = $conn->query("SELECT username FROM users;");
   $cell=$display->fetchAll();

?>

<h2><a href="signUp.php">Add-Users</a></h2>

<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body> 
            <h2>Delete-Users</h2>
                <?php
                foreach($cell as $row){
                ?> 
                <form action="deleteusers.php" method ="get">
                    <label for="username">DELETE:</label><br>
                    <input type="submit" name="delete" value="<?php echo $row['username']?>">
                </form> 
    </div>
     <?php
      }
     ?>