<?php

namespace app\Controllers;

use app\Database\DatabasePDO;
use app\Interfaces\ViewControllerInterface;
use app\Models\User;
use app\Services\Alert;
use app\Services\Validator;

class LoginController implements ViewControllerInterface
{
    private $allowed_attempts = 5;
    private $block_duration = 900;
    private $csrf_token;
    public $model;
    public $login;
    public $errors;

    public function show(string $alert = '')
    {
        $csrf_token = $this->_createCSRF();
        return view('login', [
            "csrf_token" => $csrf_token,
            "errors" => $this->errors
        ], $alert);
    }
        
    public function setModel(User $user) : void
    {
        $this->model = $user;
        return;
    }

    public function login()
    {
        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

        if($login !== '' && $password !== '') {
            if(Validator::validateCSRF($_SESSION['csrf_token']) && $this->_checkName($login)) {
                $statement = $this->model->getUserBlockedtimeStmt([':login' => $login]); // need change in future
                if($statement->rowCount()===1){
                    $statement = $statement->fetch();
                    if($statement['blocked_time']<time())
                    {
                        $id = $statement["id"];
                        $password_db = $statement["password"];
                        if($this->_comparePassword($password, $password_db)) {
                            $this->resetFailedAttempts($login);
                            $this->_createSession($id, $login);
                            return header('Location: /schedule');
                        }
                    }
                }
            }
        }
        if($this->incrementFailedAttempts($login) === 'blocked') $this->errors = 'Za dużo prób! Twoje konto zostało tymczasowo zablokowane.';
        return $this->show(Alert::failed('Błąd', 'Logowanie nie powiodło się'));
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

    public function resetFailedAttempts(string $login) : void  // resets failed_attempts in db, select user by login
    {
        $this->model->setFailedAttempts([
            ':login' => $login,
            ':failed_attempts' => 0
        ]);
        return;
    }

    public function incrementFailedAttempts(string $login) : null | string // incrementing failed_attempts in db for used login, and if failed_attempts hits the limit it will call block account method
    {
        if($this->_checkName($login)){
            $failed_count = $this->model->getFailedAttempts([":login" => $login]) ?? 0;
            if($failed_count >= $this->allowed_attempts) {
                $block_time = time() + $this->block_duration;
                $this->model->blockAccount([
                    ":login" => $login,
                    ":blocked_time" => $block_time
                ]);
                return 'blocked';
            } else {
                $failed_count++;
                $this->model->setFailedAttempts([
                    ":login" => $login,
                    ":failed_attempts" => $failed_count
                ]);
            }
        }
        return null;
    }

    // public function getUserId()
    // {
    //     return $this->model->id;
    // }

    private function _checkName($login) : bool
    {
        $this->setModel(new User);
        if($this->model->getUserNameByLogin([":login" => $login])) return true;
        return false;
    }

    private function _createCSRF()
    {
        if(!isset ($_SESSION)) session_start();
        if(!isset ($_SESSION['csrf_token']) || $this->csrf_token === null) {
            $this->csrf_token = $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    private function _comparePassword($password, $password_db)
    {
        if(password_verify($password, $password_db)) return true;
        $this->_setError();
        return false;
    }

    public function _setError()
    {
        $this->errors = "Podany login lub hasło nie jest prawidłowe"; // need change [pushing to array]
        return;
    }

    private function _createSession($id, $login)
    {
        if(!isset ($_SESSION)) session_start();
        session_regenerate_id(true);
        $_SESSION['user_id'] = $id; 
        $_SESSION['username'] = $login;
        $_SESSION['user_type'] = "test";
        $_SESSION['client_ip'] = $_SERVER['REMOTE_ADDR'];
    }
}
