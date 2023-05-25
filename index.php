<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$_SESSION['BASE_PATH'] = realpath(dirname(__FILE__));

const BASE_PATH = __DIR__ . '/../';

require_once 'app/Controllers/ViewController.php';
require_once 'app/Services/DatabaseBuilder.php';
require 'core.php';

new ViewController;



// $test = 'get';

// call_user_func([
//     'Core', $test
// ]);
