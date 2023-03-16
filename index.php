<?php

require_once('config/database.php');

$db = new Database();
$result = $db->query("users", "user_name", "id = 1");
var_dump($result);
// echo $result->$user_name;
?>
