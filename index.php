<?php

define('ROOT_DIR', __DIR__);
// require_once 'app/Controllers/LoginController.php';
// require_once 'app/Models/User.php';

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <?php 
        // if (isset($_POST['login']) && isset($_POST['password'])){
        //     $login=$_POST['login'];
        //     $password=$_POST['password'];
        //     $user = new LoginController($login, $password);
        // };
        ?> 

    <form method="POST" action="index.php">
        <div>
            <label for="login">Username:</label>
            <input type="text" name="login" id="login">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    <form method="POST" action="app/Views/login.php">
        <div>
            <button type="submit">TEST</button>
        </div>
    </form>
</body>
</html>
