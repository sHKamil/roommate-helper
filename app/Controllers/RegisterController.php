<?php

namespace app\Controllers;

use app\Database\DatabasePDO;
use app\Interfaces\ViewControllerInterface;
use app\Services\Alert;
use app\Services\Validator;

class RegisterController implements ViewControllerInterface
{
    private $csrf_token;
    public $errors;

    public function show()
    {
        $csrf_token = $this->_createCSRF();
        view('register', [
            'errors' => $this->errors,
            "csrf_token" => $csrf_token
        ]);
    }

    public function register()
    {
        $login = $_POST['login'];
        $password1 = $_POST['password'];
        $password2 = $_POST['repeat_password'];
        $user_name = $_POST['name'];

        if($this->validateInputs($login, $password1, $password2)) {
            $db = new DatabasePDO;
            $db->query("INSERT INTO users(login, password) VALUES(:login, :password)", [
                ':login' => $login,
                ':password' => password_hash($password1, PASSWORD_BCRYPT)
            ]);
            header('Location: /login');
        }
    }

    private function validateInputs($login, $password1, $password2)
    {
        if(Validator::validateCSRF($_SESSION['csrf_token'])) {
            if(!Validator::string($login, 5, 200)) $this->errors['login'] = 'Login musi mieć minimum 5 znaków oraz maksimum 200.';
            if(!Validator::string($password1, 8, 200)) $this->errors['password_min'] = 'Hasło musi mieć minimum 8 znaków oraz maksimum 200.';
            if(Validator::containNumber($password1)) $this->errors['password_num'] = 'Hasło musi zawierać przynajmniej jedną cyfrę.';
            if(Validator::containSpecialCharacter($password1)) $this->errors['password_spec'] = 'Hasło musi zawierać przynajmniej jeden znak specjalny.';
            if(($password1 !== $password2)) $this->errors['password_repeat'] = 'Hasła muszą być identyczne';
        
            if (!empty($this->errors)) return view('register', [
                'errors' => $this->errors,
                'alert' => Alert::failed('Błąd', 'Rejestracja nie powiodła się')
            ]);

            if(!$this->uniqueLogin($login)) $this->errors['login_duplicate'] = 'Taki login już istnieje';

            if (!empty($this->errors)) return view('register', [
                'errors' => $this->errors,
                'alert' => Alert::failed('Błąd', 'Rejestracja nie powiodła się')
            ]);
        } else {
            return view('register', [
                'alert' => Alert::failed('Błąd', 'Rejestracja nie powiodła się')
            ]);
        }
        return true;
    }

    private function uniqueLogin($login)
    {
        if(Validator::isNotDoubled('users', 'login', ['param' => $login])) return true;
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

}