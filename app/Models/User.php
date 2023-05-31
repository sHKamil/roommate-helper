<?php

namespace app\Models;

use app\Database\Database;
use app\Database\DatabasePDO;

class User
{
    private $db;
    public $id;
    public $login;
    public $name;
    public $lastname;

    public function findUserByLogin($login, $password)
    {
        $db = new DatabasePDO;
        $attempt = $db->query("SELECT login, password FROM users WHERE login = :login", [
            ':login' => $login,
        ]);
        if ($attempt->rowCount() === 1) {
            $data = $attempt->fetch();
            if(password_verify($password, $data['password'])) return true;
        }
        return false;
    }

    public function findUserById($id)
    {
        $this->db = new Database;
        $attempt = $this->db->defaultSelectQuery("users","id, name, lastname, login",'id='.$id.';');
 
        if ($attempt->num_rows == 1){
            $this->_asignData($attempt);
        }else{
            throw new \Exception(' Login failed. '); // better frontend needed
        }
    }

    private function _asignData($data)
    {
        $data = $data->fetch_assoc();
        $this->id = $data["id"];
        $this->login = $data["login"];
        $this->name = $data["name"];
        $this->lastname = $data["lastname"];
    }


}
