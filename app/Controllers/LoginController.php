<?php

require_once ROOT_DIR."/app/Database/Database.php";
require_once ROOT_DIR."/app/Models/User.php";

class LoginController{
    private $db;
    public $model;

    public function __construct($login, $password) {
        $this->db = new Database;
       $attempt = $this->db->defaultQuery("users","name, lastname, login, password",'login="'.$login.'" AND password = "'.$password.'"');

       if ($attempt->num_rows==1){
        $attempt=$attempt->fetch_assoc();
        $this->model = new User($attempt["login"],$attempt["name"],$attempt["lastname"]);
        echo "Jesteś zalogowany jako ".$this->model->name;
       }else{
        die("login error");
       }
    }
}