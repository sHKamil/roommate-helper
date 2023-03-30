<?php

require_once "../Database/Database.php";

class Profile
{
    private $db;
    public $id;
    public $login;
    public $name;
    public $lastname;

    public function __construct($id) {
        $this->db = new Database;
        $attempt = $this->db->defaultQuery("users","id, name, lastname, login",'id='.$id.';');
 
        if ($attempt->num_rows==1){
            $attempt=$attempt->fetch_assoc();
            $this->id = $attempt["id"];
            $this->login = $attempt["name"];
            $this->name = $attempt["lastname"];
            $this->lastname = $attempt["login"];
        }else{
            die("Query error");
        }
    }
}
