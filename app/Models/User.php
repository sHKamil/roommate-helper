<?php

require_once ROOT_DIR."/app/Database/Database.php";

class User{
    private $db;
    public $id;
    public $login;
    public $name;
    public $lastname;

    public function __construct($login, $password) {
        $this->db = new Database;
        $attempt = $this->db->defaultQuery("users","id, login",'login="'.$login.'" AND password = "'.$password.'"');
 
        if ($attempt->num_rows==1){
            $attempt=$attempt->fetch_assoc();
            $this->id = $attempt["id"];
            $this->lastname = $attempt["login"];
        }else{
            die("Query error");
        }
    }
}
