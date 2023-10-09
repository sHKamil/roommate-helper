<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . 'core.php';
spl_autoload_register('autoloader');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router = new app\Router\Router;
$routes = require_once base_path('/app/Router/web.php');
$router->route($uri, $method);
