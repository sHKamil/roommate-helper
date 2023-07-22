<?php

namespace app\Models;

use app\Abstract\AbstractModel;
use app\Database\DatabasePDO;

class User extends AbstractModel
{

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

    public function updateAvatarById(array $params = []) : bool
    {
        try
        {

            if($this->db->query("UPDATE " . $this->table . " SET avatar = :avatar WHERE id = :id ", $params) !== false) {
                return true;
            };
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getFailedAttempts(array $params = []) : int | null
    {
        return $this->getByWhere($params, 'failed_attempts', 'login = :login')->fetch()['failed_attempts'];
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
        if($this->getByWhere($params, 'name', 'login = :login')->rowCount()===1) return true;
        return false;
    }

    public function getUserBlockedtimeStmt(array $params = [])
    {
        return $this->getByWhere($params, 'id, password, blocked_time', 'login = :login');
    }

    public function quitGroup(array $params = []) : bool
    {
        $this->db->query("UPDATE " . $this->table . " SET group_id = null WHERE id = :id ", $params);
        return true;
    }

    public function getUserData(array $params = []) : array | false
    {
        return $this->getByWhere($params, 'id, login, password, name, lastname, group_id, email, user_type, avatar', 'login = :login')->fetch();
    }

    public function getUserNameById(array $params = []) : array | false
    {
        return $this->getByWhere($params, 'name', 'id = :id')->fetch();
    }

    public function getUserAvatarById(array $params = []) : array | false
    {
        return $this->getByWhere($params, 'avatar', 'id = :id')->fetch();
    }
}
