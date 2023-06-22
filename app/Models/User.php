<?php

namespace app\Models;

use app\Database\DatabasePDO;
use app\Services\ModelHandler;

class User
{
    private $db;
    public $allColumns = [];
    public $fillable = [];
    public $table;

    public function __construct() {
        $this->_prepareFields();
        $this->db = new DatabasePDO;
    }

    private function _prepareFields() : void
    {
        $this->allColumns = [
            'id',
            'login',
            'password',
            'name',
            'lastname',
            'group_id',
            'email',
            'user_type',
            'failed_attempts',
            'blocked_time'
        ];
        $this->fillable = [
            'login',
            'password',
            'name',
            'lastname',
            'group_id',
            'email',
            'user_type',
            'failed_attempts',
            'blocked_time'
        ];
        $this->table = 'users';
    }

    public function findUserByLogin(string $login, string $password)
    {
        $attempt = $this->db->query("SELECT login, password FROM users WHERE login = :login", [
            ':login' => $login,
        ]);
        if ($attempt->rowCount() === 1) {
            $data = $attempt->fetch();
            if(password_verify($password, $data['password'])) return true;
        }
        return false;
    }
        
    public function addUser(array $params = []) : void
    {
        $fillable = $this->fillable;
        $columns = ModelHandler::prepareFillableForSQL($fillable);
        $placeholders = ModelHandler::preparePlaceholders($fillable);
        $params = ModelHandler::createDictionaryParams($this->fillable, $params);
        try
        {
            $this->db->query("INSERT INTO " . $this->table . "(" . $columns . ") VALUES (" . $placeholders . ")", $params);
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
    }

    public function updateById(array $params = []) : bool
    {
        try
        {

            if($this->db->query("UPDATE " . $this->table . " SET name = :user_name, lastname = :user_lastname, email = :user_email WHERE id = :id ", $params) !== false) {
                return true;
            };
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getFailedAttempts(array $params = []) : int | null
    {
        try
        {
            return $this->db->query("SELECT failed_attempts FROM " . $this->table . " WHERE login = :login ", $params)->fetch()['failed_attempts'];
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return null;
    }
    
    public function blockAccount(array $params = []) : void // sets block_date for user in db 
    {
        try
        {
            $this->db->query("UPDATE " . $this->table . " SET blocked_time = :blocked_time WHERE login = :login ", $params);
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return;
    }

    public function setFailedAttempts(array $params = []) : void // sets failed_attempts for user in db
    {
        try
        {
            $this->db->query("UPDATE " . $this->table . " SET failed_attempts = :failed_attempts WHERE login = :login ", $params);
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return;
    }

    public function asign(array $params) : void
    {
        try
        {
            $this->db->query("UPDATE " . $this->table . " SET group_id = :group_id WHERE id = :id ", $params);
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return;
    }
    
    public function getUserNameByLogin(array $params = []) : bool
    {
        try
        {
            if($this->db->query("SELECT name FROM " . $this->table . " WHERE login = :login ", $params)->rowCount()===1) return true;
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getUserBlockedtimeStmt(array $params = [])
    {
        try
        {
            return $this->db->query("SELECT id, password, blocked_time FROM users WHERE login = :login", $params);
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function quitGroup(array $params = []) : bool
    {
        $this->db->query("UPDATE " . $this->table . " SET group_id = null WHERE id = :id ", $params);
        return true;
    }

    public function getUserData(array $params = []) : array | false
    {
        $stmt = $this->db->query("SELECT id, login, password, name, lastname, group_id, email, user_type, avatar FROM users WHERE login = :login", $params)->fetch();
        return $stmt;
    }

    public function getUserNameById(array $params = []) : array | false
    {
        $result = $this->db->query("SELECT name FROM users WHERE id = :id", $params)->fetch();
        return $result;
    }
}
