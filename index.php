<?php

define('ROOT_DIR', __DIR__);
require_once('app/Database/Database.php');

$db = new Database();
$result = $db->query("users", "user_name", "id = 1");

// var_dump($result);
echo mysqli_fetch_assoc($result)['user_name'];
?>
