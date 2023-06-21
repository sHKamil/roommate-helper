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
            'start',
            'end'
        ];
        $this->fillable = [
            'group_id',
            'user_id',
            'event_name',
            'content',
            'day',
            'start',
            'end'
        ];
        $this->table = 'events';
    }
        
    public function addEvent(array $params = []) : bool
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

    public function getEventsByGroupID(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT id, event_name, content, day, start, end FROM " . $this->table . " WHERE group_id = :group_id ", $params)->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getAllGroupEvents(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT start, end, day, event_name, content  FROM " . $this->table . " WHERE group_id = :group_id ", $params)->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getWeeklyGroupEvents(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT start, end, day, event_name, content  FROM " . $this->table . " WHERE group_id = :group_id AND day >= :monday AND day <= :sunday ORDER BY day", $params)->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }

    public function getDailyGroupEvents(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT start, end, event_name, content  FROM " . $this->table . " WHERE group_id = :group_id AND day = :day ORDER BY start", $params)->fetchAll();
            return $result;
        } catch (\PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
        return false;
    }
}
