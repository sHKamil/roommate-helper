<?php

namespace app\Models;

use app\Database\DatabasePDO;
use app\Services\ModelHandler;

class Event
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
            'event_name',
            'content',
            'day',
            'hour',
            'duration'
        ];
        $this->fillable = [
            'group_id',
            'user_id',
            'event_name',
            'content',
            'day',
            'hour',
            'duration'
        ];
        $this->table = 'events';
    }
        
    public function addEvent(array $params = []) : void
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

    public function getAllGroupEvents(array $params = []) : array | false
    {
        try
        {
            return $this->db->query("SELECT user_id, event_name, content, day, hour, duration FROM " . $this->table . " WHERE group_id = :group_id ", $params)->fetchAll();
        } catch (\Exception $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }
}
