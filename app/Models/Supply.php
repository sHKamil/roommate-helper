<?php

namespace app\Models;

use app\Abstract\AbstractModel;
use app\Database\DatabasePDO;
use app\Services\ModelHandler;

class Supply extends AbstractModel
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
        
    public function getMiniSuppliesByGroupID(array $params = []) : array | false
    {
        try
        {
            $result = $this->db->query("SELECT quantity, quantity_max, name, expected_end FROM " . $this->table . " WHERE group_id = :group_id ", $params)->fetchAll();
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

    public function updateByGroupIdAndId(array $params, string $columns) : bool
    {
        $where = 'id = :id AND group_id = :group_id';
        return $this->updateByWhere($params, $columns, $where);
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
