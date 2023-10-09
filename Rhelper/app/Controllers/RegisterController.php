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

    public function show(string $alert = '')
    {
        $csrf_token = $this->_createCSRF();
        view('register', [
            'errors' => $this->errors,
            "csrf_token" => $csrf_token
        ], $alert);
    }

    public function register()
    {
        $login = isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '';
        $password1 = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
        $password2 = isset($_POST['repeat_password']) ? htmlspecialchars($_POST['repeat_password']) : '';
        $user_name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $user_lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
        $user_email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
        $user_type = 'member';

        if($this->validateInputs($login, $password1, $password2, $user_name, $user_lastname, $user_email)) {
            $db = new DatabasePDO;
            $db->query("INSERT INTO users(login, password, name, lastname, email, user_type) VALUES(:login, :password, :name, :lastname, :email, :user_type)", [
                ':login' => $login,
                ':password' => password_hash($password1, PASSWORD_BCRYPT),
                ':name' => $user_name,
                ':lastname' => $user_lastname,
                ':email' => $user_email,
                ':user_type' => $user_type
            ]);
            header('Location: /login');
        }
    }

    private function validateInputs($login, $password1, $password2, $user_name, $user_lastname, $user_email)
    {
        if(Validator::validateCSRF($_SESSION['csrf_token'])) {
            if(!Validator::string($login, 5, 200)) $this->errors['login'] = 'Login musi mieć minimum 5 znaków oraz maksimum 200.';
            if(!Validator::string($password1, 8, 200)) $this->errors['password_min'] = 'Hasło musi mieć minimum 8 znaków oraz maksimum 200.';
            if(Validator::containNumber($password1)) $this->errors['password_num'] = 'Hasło musi zawierać przynajmniej jedną cyfrę.';
            if(Validator::containSpecialCharacter($password1)) $this->errors['password_spec'] = 'Hasło musi zawierać przynajmniej jeden znak specjalny.';
            if(!Validator::string($user_name, 1, 15)) $this->errors['user_name'] = 'Imię może mieć maksymalnie 15 znaków.';
            if(!Validator::string($user_lastname, 1, 40)) $this->errors['user_name'] = 'Nazwisko może posiadać maksymalnie 40 znaków';
            if(($password1 !== $password2)) $this->errors['password_repeat'] = 'Hasła muszą być identyczne';
        
            if (!empty($this->errors)) return $this->show(Alert::failed('Błąd', 'Rejestracja nie powiodła się'));

            if(!$this->uniqueLogin($login)) $this->errors['login_duplicate'] = 'Taki login już istnieje';

            if (!empty($this->errors)) return $this->show(Alert::failed('Błąd', 'Rejestracja nie powiodła się'));
        } else {
            return $this->show(Alert::failed('Błąd', 'Rejestracja nie powiodła się'));
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