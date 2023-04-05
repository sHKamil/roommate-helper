<?php
session_start();

$_SESSION['BASE_PATH'] = realpath(dirname(__FILE__));


require_once 'app/Controllers/LoginController.php';
// require_once 'app/Controllers/ProfileController.php';
// require_once 'app/Views/register.php';
// require_once 'app/Views/login.php';
// require_once 'app/Database/Database.php';
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
        if(isset($_POST['login']) && isset($_POST['password'])){
            $login=$_POST['login'];
            $password=$_POST['password'];
            $user = new LoginController($login, $password);
            $user->LogIn();
            echo "Zostałeś zalogowany jako ".$user->model->name;
        }elseif(isset($_SESSION['id']) && isset($_SESSION['login'])){
            $profile = new ProfleController($_SESSION['id']);
            echo "Witaj ".$profile->model->name."!";
        }else{
            header("Location: app/views/login.php");
        }
        ?>
    <form method="POST" action="logout.php">
        <div>
            <button type="submit">Wyloguj</button>
        </div>
    </form>
</body>
</html>
