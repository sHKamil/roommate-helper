<?php

namespace app\Controllers;

use app\Database\Database;

class RegisterController
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    public function addUser($login, $password, $name, $lastname)
    {
        $rows = '"'.$login.'","'.$password.'","'.$name.'","'.$lastname.'"';
        $this->db->insertQuery("users","login,password,name,lastname",$rows);
    }
}
