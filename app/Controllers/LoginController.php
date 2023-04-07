<?php

require_once $_SESSION['BASE_PATH']."/app/Models/User.php";

class LoginController
{
    public $model;

    public function __construct($login, $password) {
        $this->model = new User($login, $password);
    }

    public function LogIn()
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $_SESSION["id"]=$this->model->id;
        $_SESSION["login"]=$this->model->login;
    }

    public function LogOut()
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        session_destroy();
    }

    public function GetUserId()
    {
        return $this->model->id;
    }
}
