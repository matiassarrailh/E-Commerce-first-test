<?php
   session_start();
   $_SESSION['isLoggedIn'] = "no";
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
    
    //SIGN UP
    
    if(isset($_POST['signUpSubmit'])){
        $sql1 = "INSERT INTO users (username, password, email) VALUES ('" . $_POST['name'] . "','" . $_POST['password'] . "','" . $_POST['email'] . "')";
        if($conn->exec($sql1) != NULL){
            header("Location:signIn.php");
        }else {
            echo "PDO ERROR: " . $e->getMessage() . " storage in error.log.\n";
            $myerr =  "PDO ERROR: " . $e->getMessage() . " storage in error.log\n";
            file_put_contents("error.log", $myerr, FILE_APPEND);
            header("Location:signIn.php");
        }
    //SIGN IN
    } else if(isset($_POST['signInSubmit'])){
        $tempEmail = $_POST['emailForLogin'];
        $tempPassword = $_POST['passwordForLogin'];
        $emailLogin = $conn->query("SELECT email FROM users WHERE email = '$tempEmail'");
        $passwordLogin = $conn->query("SELECT password FROM users WHERE password = '$tempPassword'");
        if($emailLogin->fetchColumn() == $tempEmail && $passwordLogin->fetchColumn() == $tempPassword && !empty($tempEmail) && !empty($tempPassword)){
            if($_SESSION['isLoggedIn']!="logged"){
                $_SESSION['isLoggedIn'] = "logged";
            }
        }elseif(empty($tempEmail) || empty($tempPassword) || $tempEmail != $emailLogin->fetchColumn() || $tempPassword != $passwordLogin->fetchColumn()){
            header("Location:signIn.php");
        }
        else {
            echo "PDO ERROR: " . $e->getMessage() . " storage in error.log.\n";
            $myerr =  "PDO ERROR: " . $e->getMessage() . " storage in error.log\n";
            file_put_contents("error.log", $myerr, FILE_APPEND);
        }
    }

    $productsQuery = $conn->query("SELECT * FROM products;");
    $productsResult = $productsQuery->fetchAll();
    $productsQuery->closeCursor();
    
?>

<!DOCTYPE html>
    <html>
        <head>

            <title>My E-commerce Not Logged In</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="css/styles.css">

        </head>
        <body>

            <!-- NAVIGATION DIVISION-->
            <div class = "container-fluid">
                <!-- HOME - SHOP - MAGAZINE-->
                <nav class="navbar navbar-expand-lg navbar-light">
                <div class = "row container-fluid">
                    <div class = "col-1"><img src="css/images/Logo.png" alt=""></div>
                    <div class = "col-2">
                        <div class = "row">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">SHOP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">MAGAZINE</a>
                            </li>
                            </ul>
                            
                        </div>
                        </div>
                    </div>
                    <div class = "col-6"></div>
                    <div class = "col-3">
                        <div class = "row">
                            <div class = "col-3"></div>
                            <div class = "col-3"><img class = "imgCart" src="css/images/Cart Button.png" alt=""></div>
                            <div class = "col-3"><div class = "navAlign">
                                <?php 
                                    if($_SESSION['isLoggedIn'] == "logged"){
                                        echo "<a href = " . "signIn.php" . ">LOG OUT</a>";

                                    }else{
                                        echo "<a href = " . "signIn.php" . ">LOG IN</a>";
                                    }
                                ?>
                            </div></div>
                            <div class = "col-3"></div>
                                </div>
                    </div>
                </div>
                                </nav>

                <!-- SEARCH BOX SECTION-->

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
            <!-- CLOSE NAVIGATION DIVISION -->

            <!-- PRODUCTS DIVISION -->
            <div class = "container-fluid">
                <div class = "row row-cols-1 row-cols-md-4">
                    <div class = "col">
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
                    </div>

                    <!-- FOREACH LOOP PRODUCTS SHOWROOM -->

                    <?php
                      foreach ($productsResult as $row) {
                    ?>
                    <div class="col">
                        <div class="products">
                            <img src="css/images/<?php echo $row['name'] ?>.png" alt="" width="100%"> </br>
                            <p class="prodDesc"><?php echo $row['name'] ?></p>
                            <p class="prodDescB">$<?php echo $row['price'] ?></p>
                        <div class="row">
                            <div class="col">
                                <img src="css/images/Star - On.png" style="float: left" alt="">
                                <img src="css/images/Star - On.png" style="float: left" alt="">
                                <img src="css/images/Star - On.png" style="float: left" alt="">
                                <img src="css/images/Star - On.png" style="float: left" alt="">
                                <img src="css/images/Star.png" style="float: left" alt="">
                            </div>
                            <div class="col">
                                <img class="" src="css/images/Cart Button.png" style="float: right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                    
                <!-- CLOSE FOREACH LOOP PRODUCTS SHOWROOM -->
                    
            </div>
            <!-- CLOSE PRODUCTS DIVISION -->
            <!-- CLOSE NAVIGATION DIVISION -->

            <!-- PAGINATION SECTION-->
            <section class="paginacion">
		        <ul>
		        	<li><a href="pagina1.html" class="active">1</a></li>
	        		<li><a href="pagina2.html">2</a></li>
	        		<li><a href="pagina3.html">3</a></li>
        			<li><a href="pagina4.html">4</a></li>
			        <li><a href="pagina5.html">5</a></li>
	            </ul>
	        </section>
            <!-- CLOSE PAGINATION SECTION-->
        </body>
    </html>