<?php
// session_start();
require_once $_SESSION['BASE_PATH']."/app/Models/User.php";

class LoginController
{
    public $model;

    public function __construct() {
        $this->model = new User();
        $this->login();
    }

    public function login()
    {
        $login = (isset($_POST['login']) && isset($_POST['password'])) ? $_POST['login'] : exit();
        $password = $_POST['password'];
        try {
            $this->model->findUserByLogin($login, $password);
            
        } catch (Exception $e) {
            echo 'Caught exeption', $e->getMessage(), "\n";
        }


        // session_start();
        $_SESSION["id"]=$this->model->id;
        $_SESSION["login"]=$this->model->login;
    }

    public function LogOut()
    {
        session_start();
        session_destroy();
    }

    public function GetUserId()
    {
        return $this->model->id;
    }
}
