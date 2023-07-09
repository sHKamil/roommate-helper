<?php

namespace app\Abstract;

use app\Database\DatabasePDO;
use app\Services\ModelHandler;

abstract class AbstractModel
{
    protected $db;
    public $allColumns = [];
    public $fillable = [];
    public $table;
        
    public function getAll() : array | false
    {
        $fillable = $this->fillable;
        $columns = ModelHandler::prepareFillableForSQL($fillable);
        try
        {
            $result = $this->db->query("SELECT $columns FROM " . $this->table .";")->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function add(array $params = []) : bool
    {
        $fillable = $this->fillable;
        $columns = ModelHandler::prepareFillableForSQL($fillable);
        $placeholders = ModelHandler::preparePlaceholders($fillable);
        try
        {
            if($this->db->query("INSERT INTO " . $this->table . "(" . $columns . ") VALUES (" . $placeholders . ")", $params) !== false) return true;
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
            return false;
        }
    }

    public function updateById(array $params, string $columns) : bool
    {
        try
        {
            $db = new DatabasePDO;
            if($db->query("UPDATE $this->table SET $columns WHERE id = :id", $params) !== false) {
                return true;
            };
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getByWhere(array $params, string $select, string $where) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT $select FROM " . $this->table . " WHERE $where", $params)->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function deleteById(array $params = []) : bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id;";
        try
        {
            if($this->db->query($query, $params) !== false) return true;
        } catch (\PDOException $e) {
            echo "Delete query failed: " . $e->getMessage();
            return false;
        }
    }
}
