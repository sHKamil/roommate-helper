<?php

namespace app\Controllers;

use app\Models\User;

class LoginController
{
    public $model;
    public $login;
    public $errors = [];

    public function show()
    {
        view('login', ['error' => $this->errors]);
    }

    public function login()
    {
        if($this->attempt()) {
            $this->_createSession($this->login);
            header('Location: /schedule');
        }else{
            $this->errors = ['Niepoprawny login lub hasło'];
            return view('login', ['error' => $this->errors]);
        }
    }

    public function logout()
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        session_destroy();
        header('Location: /');
    }

    public function attempt()
    {
        $this->model = new User();
        $this->login = (isset($_POST['login']) && isset($_POST['password'])) ? $_POST['login'] : exit();
        $password = $_POST['password'];

        if($this->model->findUserByLogin($this->login, $password)){
            return true;
        }
        return false;
    }

    public function getUserId()
    {
        return $this->model->id;
    }

    private function _createSession($login)
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
        $_SESSION["login"]=$login;
        $_SESSION["user_type"]='member';
    }
}
