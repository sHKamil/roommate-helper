<?php

namespace app\Models;

use app\Database\DatabasePDO;
use app\Services\ModelHandler;

class Supply
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
            'group_id',
            'user_id',
            'name',
            'quantity_max',
            'quantity',
            'expected_end',
            'last_check'
        ];
        $this->fillable = [
            'group_id',
            'user_id',
            'name',
            'quantity_max',
            'quantity',
            'expected_end',
            'last_check'
        ];
        $this->table = 'supply';
    }
        
    public function addSupply(array $params = []) : bool
    {
        $fillable = $this->fillable;
        $columns = ModelHandler::prepareFillableForSQL($fillable);
        $placeholders = ModelHandler::preparePlaceholders($fillable);
        try
        {
            if($this->db->query("INSERT INTO " . $this->table . "(" . $columns . ") VALUES (" . $placeholders . ")", $params) !== false) {
                return true;
            };
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
            return false;
        }
    }
        
    public function getSuppliesByGroupID(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT id, name, quantity, quantity_max, expected_end, last_check FROM " . $this->table . " WHERE group_id = :group_id ", $params)->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }
        
    public function getSupplyByGroupIdAndId(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT id, name, quantity, quantity_max, expected_end, last_check, user_id FROM " . $this->table . " WHERE group_id = :group_id AND id = :id", $params)->fetch();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function updateById(array $params = []) : bool
    {
        try
        {

            if($this->db->query("UPDATE " . $this->table . " SET user_id = :user_id, name = :name, quantity_max = :quantity_max, quantity = :quantity, expected_end = :expected_end, last_check = :last_check WHERE id = :id AND group_id = :group_id", $params) !== false) {
                return true;
            };
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function deleteByGroupIdAndId(array $params = []) : bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id AND group_id = :group_id;";
        try
        {
            if($this->db->query($query, $params) !== false) return true;
        } catch (\PDOException $e) {
            echo "Delete query failed: " . $e->getMessage();
            return false;
        }
    }


}
