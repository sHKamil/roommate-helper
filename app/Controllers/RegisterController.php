<?php

namespace app\Controllers;

use app\Database\DatabasePDO;
use app\Services\Validator;

class RegisterController
{
    public $errors;

    public function show()
    {
        view('register.php');
    }

    public function register()
    {
        $login = $_POST['login'];
        $password1 = $_POST['password'];
        $password2 = $_POST['repeat_password'];

        if($this->validateInputs($login, $password1, $password2)) {
            $db = new DatabasePDO;
            $db->query("INSERT INTO users(nazwa, haslo) VALUES(:login, :password)", [
                ':login' => $login,
                ':password' => password_hash($password1, PASSWORD_BCRYPT)
            ]);
            header('Location: /login');
        }
    }

    private function validateInputs($login, $password1, $password2)
    {
  
        if(!Validator::string($login, 5, 200)) $this->errors['login'] = 'Login musi mieć minimum 5 znaków oraz maksimum 200.';
        if(!Validator::string($password1, 8, 200)) $this->errors['password_min'] = 'Hasło musi mieć minimum 8 znaków oraz maksimum 200.';
        if(Validator::containNumber($password1)) $this->errors['password_num'] = 'Hasło musi zawierać przynajmniej jedną cyfrę.';
        if(Validator::containSpecialCharacter($password1)) $this->errors['password_spec'] = 'Hasło musi zawierać przynajmniej jeden znak specjalny.';
        if(($password1 !== $password2)) $this->errors['password_repeat'] = 'Hasła muszą być identyczne';
    
        if (!empty($this->errors)) return view('register.php', ['errors' => $this->errors]);

        if(!$this->uniqueLogin($login)) $this->errors['login_duplicate'] = 'Taki login już istnieje';

        if (!empty($this->errors)) return view('register.php', ['errors' => $this->errors]);
        return true;
    }

    private function uniqueLogin($login)
    {
        if(Validator::isNotDoubled('users', 'nazwa', $login)) return true;
        return false;
    }

}