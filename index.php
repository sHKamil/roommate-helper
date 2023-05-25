<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$_SESSION['BASE_PATH'] = realpath(dirname(__FILE__));

// const BASE_PATH = __DIR__ . '/../';
const BASE_PATH = __DIR__ ;

require_once 'app/Controllers/ViewController.php';
require_once 'app/Services/DatabaseBuilder.php';
require_once 'core.php';
require_once base_path('/app/Router/Router.php');

// new ViewController;

// $test = 'get';

// call_user_func([
//     'Core', $test
// ]);

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router = new Router;
$routes = require_once base_path('/app/Router/web.php');
$router->route($uri, $method);