<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Roommate-helper</title>
</head>
<body>
    <section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="">
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Sign up</p>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="login" class="form-control form-control-lg" placeholder="Enter your login" />
                        <label class="form-label" for="login">Login</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password" />
                        <label class="form-label" for="password">Password</label>
                    </div>

                    <!-- Name input -->
                    <div class="form-outline mb-3">
                        <input type="password" name="repeat_password" class="form-control form-control-lg" placeholder="repeat password" />
                        <label class="form-label" for="repeat_password">Repeat password</label>
                    </div>

                    <!-- Lastname input -->
                    <div class="form-outline mb-3">
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter lastname" />
                        <label class="form-label" for="name">Name</label>
                    </div>


                    <div class="d-grid gap-2 col-6 mx-auto">
                        <input type="submit" class="btn btn-primary btn-lg" value="Register"/>
                        <p class="small fw-bold mt-2 pt-1 mb-0">
                            Do you have an account? 
                            <a href="login.php" class="link-danger">Login instead</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
        </div>
        <div>
            <!-- Right -->
        </div>
    </div>
    </section>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
