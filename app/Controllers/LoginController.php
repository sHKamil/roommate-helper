<?php
// session_start();
require_once $_SESSION['BASE_PATH']."/app/Models/User.php";

class LoginController
{
    public $model;

    // public function __construct() {
    //     $this->model = new User();
    //     $this->login();
    // }

    public function login()
    {
        $this->model = new User();
        $login = (isset($_POST['login']) && isset($_POST['password'])) ? $_POST['login'] : exit();
        $password = $_POST['password'];
        try {
            $this->model->findUserByLogin($login, $password);
            $_SESSION["id"]=$this->model->id;
            $_SESSION["login"]=$this->model->login;
            header("Location: index.php");
        } catch (Exception $e) {
            echo 'Caught exeption', $e->getMessage(), "\n";
        }
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
