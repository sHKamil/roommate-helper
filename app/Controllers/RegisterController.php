<?php

require_once "../Database/Database.php";

class RegisterController
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    public function AddUser($login, $password, $name, $lastname)
    {
        $rows = '"'.$login.'","'.$password.'","'.$name.'","'.$lastname.'"';
        $this->db->insertQuery("users","login,password,name,lastname",$rows);
    }
}
