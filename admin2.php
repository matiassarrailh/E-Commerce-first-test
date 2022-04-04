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

    $productsQuery = $conn->query("SELECT * FROM products;");
    $productsResult = $productsQuery->fetchAll();
    $productsQuery->closeCursor();

?>

<!DOCTYPE html> <!-- MAIN PAGE WHEN NO USER IS CONNECTED. A LOGIN BUTTON SHOULD REDIRECT TO A LOGIN PAGE WITH REGISTER OPTION ALSO-->
    <html>
        <head>

            <title>My E-commerce Not Logged In</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="css/styles.css">

        </head>
        <body>

            <!-- NAVIGATION DIVISION-->
            <div class = "container-fluid">
                <div class = "row">
                    <div class = "col-1"><img src="css/images/Logo.png" alt=""></div>
                        <div class = "col-2">
                            <div class = "row">
                                <div class = "col-4"><div class = "navAlign">HOME</div></div>
                                <div class = "col-4"><div class = "navAlign">SHOP</div></div>
                                <div class = "col-4"><div class = "navAlign">MAGAZINE</div></div>
                            </div>
                        </div>
                         <div class = "col-6"></div>
                         <div class = "col-3">
                            <div class = "row">
                            <div class = "col-3"></div>
                            <div class = "col-3"><img class = "imgCart" src="css/images/Cart Button.png" alt=""></div>
                            <div class = "col-3"><div class = "navAlign"><a href="addproducts.php">Add-Products</a></p><br/></div></div>
                            <div class = "col-3"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class = "col-1">
                        <div class = "row">
                            <div class = "col-6"><img class = "searchBTN" src="css/images/Search.png" alt=""></div>
                            <div class = "col-6"></div>
                        </div>
                    </div>
                    <div class = "col-8"><div class = "searchBox"><p>living room</p><p class = "poweredBy">Powered By Algolia &nbsp;&nbsp;<img src="css/images/Sajari Logo.png" alt=""></p></div></div>
                    <div class = "col-2"><div class = "dropdown"><button type = "button" class = "btn btn-light dropdown-toggle" data-bs-toggle = "dropdown">Best match</button></div></div>
                    <div class = "col-1"></div>
                </div>
            </div>
            <!-- CLOSE NAVIGATION DIVISION-->

            <!-- PRODUCTS DIVISION -->
            <div class = "container-fluid">
                <div class = "row" class = "productsRow1">
                    <div class = "col-3">
                        <div class = "filterBy">FILTER BY</div>
                            <button type = "button" class = "btn btn-light dropdown-toggle" data-bs-toggle = "dropdown">Collection</button>
                            <button type = "button" class = "btn btn-light dropdown-toggle" data-bs-toggle = "dropdown">Color</button>
                            <button type = "button" class = "btn btn-light dropdown-toggle" data-bs-toggle = "dropdown">Category</button> 
                            <div>
                            
                             <form action="showproducts.php" method="post">
                                <select name="category_id">
                                 <option value="1">tables&chairs</option>
                                 <option value="2">lounge</option>
                                 <option value="3">shelves</option>
                                 <select>
                                 <input type='submit' name='command' value='show'>
                             </form>

                            </div>
                                 <div class ="add"><p><a href="displayusers.php">*Display-Users</a></p></div>
                                    <div class ="add"><p><a href="logout.php">*LOG-OUT</a></p></div>
                        </div>
                    
                  <!-- HERE IS GOING TO BE THE FOREACH -->
                  <?php
                    foreach ($productsResult as $row){
                    ?>
                    <div class = "col-3">
                        <div class = "products">
                            <img src="css/images/<?php echo $row['name']?>.png" alt="">   
                            <p class = "prodDesc"><?php echo $row['name']?></p><p class ="prodDescB">$<?php echo $row['price']?></p>
                            <div>
                                <img src="css/images/Star - On.png" alt="">
                                <img src="css/images/Star - On.png" alt="">
                                <img src="css/images/Star - On.png" alt="">
                                <img src="css/images/Star - On.png" alt="">
                                <img src="css/images/Star.png" alt="">
                                <form action="deleteproducts.php" method ="get">
                                    <label name="delete">Delete:</label>
                                    <input type="submit" name="delete" value="<?php echo $row['name'] ?>">
                                </form> 
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                    <!-- CLOSE NAVIGATION DIVISION-->
                    </body>
                    </hmtl>