<?php

// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

// $_SESSION['BASE_PATH'] = realpath(dirname(__FILE__));


// require_once 'app/Controllers/ViewController.php';
// require_once 'app/Services/DatabaseBuilder.php';

// new ViewController;

require 'core.php';

$test = 'get';

call_user_func([
    'Core', $test
]);
