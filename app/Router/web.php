<?php

$router->get('/', 'app/Controllers/LoginnController.php', 'app\Controllers\LoginController', 'show');
$router->get('/schedule','app/Views/ScheduleController.php', 'app\Controllers\ScheduleController', 'show');
