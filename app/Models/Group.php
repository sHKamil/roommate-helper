<?php

namespace app\Models;

use app\Database\DatabasePDO;
use app\Services\ModelHandler;

class Group
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
            'token',
            'name'
        ];
        $this->fillable = [
            'token',
            'name'
        ];
        $this->table = 'groups';
    }
        
    public function addGroup(array $params = []) : void
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
        
    public function findGroupByToken(array $params = [])
    {
        try
        {
            $stmt = $this->db->query("SELECT name FROM " . $this->table . " WHERE token = :token ", $params);
            return $stmt;
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }
        
    public function getIdByToken(array $params = [])
    {
        try
        {
            $stmt = $this->db->query("SELECT id FROM " . $this->table . " WHERE token = :token ", $params)->fetch()['id'];
            return $stmt;
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }
}
