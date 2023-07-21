<?php

namespace app\Models;

use app\Abstract\AbstractModel;
use app\Database\DatabasePDO;

class Event extends AbstractModel
{

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
        
    public function updateByIdAndGroupId(array $params, string $columns) : bool
    {
        return $this->updateByWhere($params, $columns, 'id = :id AND group_id = :group_id');
    }
    
    public function getEventByGroupIdAndId(array $params = []) : array | false
    {
        return $this->getByWhere($params, 'id, event_name, content, day, start, end, user_id', 'group_id = :group_id AND id = :id')->fetch();
    }

    public function getEventsByGroupID(array $params = []) : array | false
    {
        return $this->getByWhere($params, 'id, event_name, content, day, start, end', 'group_id = :group_id')->fetchAll();
    }

    public function getAllGroupEvents(array $params = []) : array | false
    {
        return $this->getByWhere($params, 'start, end, day, event_name, content', 'group_id = :group_id')->fetchAll();
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
