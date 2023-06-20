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
        
    public function addSupply(array $params = []) : void
    {
        $fillable = $this->fillable;
        $columns = ModelHandler::prepareFillableForSQL($fillable);
        $placeholders = ModelHandler::preparePlaceholders($fillable);
        try
        {
            $this->db->query("INSERT INTO " . $this->table . "(" . $columns . ") VALUES (" . $placeholders . ")", $params);
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
    }
        
    public function findSuppliesByGroupID(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT name FROM " . $this->table . " WHERE group_id = :group_id ", $params)->fetchAll();
            return $result;
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function updateById(array $params = []) : bool
    {
        try
        {
            if($this->db->query("UPDATE " . $this->table . " SET name = :name, quantity_max = :quantity_max, quantity = :quantity, expected_end = :expected_end WHERE id = :id AND group_id = :group_id", $params) !== false) {
                return true;
            };
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }


}
