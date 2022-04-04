
<!DOCTYPE html>
    <html>
        <head>
            <title>Login</title>
        </head>
        <body>
            <!-- Section: Design Block -->
            <section class=" text-center text-lg-start">
                <div class="card mb-3">
                    <div class="col-lg-8">
                        <div class="card-body py-5 px-md-5">
                            <form action = "index.php" method = "post">
                                <!-- Email input -->
                                    <label class="form-label" for="form2Example1">Email address</label>
                                    <input type="email" name = "emailForLogin"/>
                                <!-- Password input -->
                                    <label class="form-label" for="form2Example2">Password</label>
                                    <input type="password" name = "passwordForLogin"/>
                                <!-- Submit button -->
                                <input type="submit" name="signInSubmit" value="LOGIN">
                            </form>
                        </div>
                        <div>
                            <a href = "signUp.php"> Registrarse </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Section: Design Block -->
        </body>
</html>