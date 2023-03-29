<?php

require_once ROOT_DIR."/app/Models/User.php";

class LoginController{
    public $model;

    public function __construct($login, $password) {
        $this->model = new User($login, $password);
    }

    public function LogIn()
    {
        $_SESSION["id"]=$this->model->id;
        $_SESSION["login"]=$this->model->login;
    }

    public function LogOut()
    {
        session_destroy();
    }

    public function GetUserId()
    {
        return $this->model->id;
    }
}
