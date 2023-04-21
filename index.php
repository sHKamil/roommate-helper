<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$_SESSION['BASE_PATH'] = realpath(dirname(__FILE__));


require_once 'app/Controllers/ViewController.php';
require_once 'app/Services/DatabaseBuilder.php';
// require_once 'app/Controllers/LoginController.php';
// require_once 'app/Controllers/ProfileController.php';
// require_once 'app/Views/register.php';
// require_once 'app/Views/login.php';
// require_once 'app/Database/Database.php';
// require_once 'app/Models/User.php';

new ViewController;
// new DatabaseBuilder;
