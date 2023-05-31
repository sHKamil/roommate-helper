<?php

namespace app\Controllers;

use app\Models\User;

class LoginController
{
    public $model;
    public $error;

    public function show()
    {
        view('login.php');
    }

    public function login()
    {
        $this->model = new User();
        $login = (isset($_POST['login']) && isset($_POST['password'])) ? $_POST['login'] : exit();
        $password = $_POST['password'];

        if($this->model->findUserByLogin($login, $password)){
            $_SESSION["id"]=$this->model->id;
            $_SESSION["login"]=$this->model->login;
            $_SESSION["user_type"]='member';
            header("Location: /schedule");
        }else{
            $this->error = ['Niepoprawny login lub hasło'];
            return view('login.php', $this->error);
        };
    }

    public function logOut()
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        session_destroy();
    }

    public function getUserId()
    {
        return $this->model->id;
    }
}
