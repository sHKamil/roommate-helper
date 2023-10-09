<?php

namespace app\Models;

use app\Abstract\AbstractModel;
use app\Database\DatabasePDO;

class Group extends AbstractModel
{

    public function __construct() {
        $this->_prepareFields();
        $this->db = new DatabasePDO;
    }

    private function _prepareFields() : void
    {
        $this->allColumns = [
            'id',
            'token',
            'name',
            'user_id'
        ];
        $this->fillable = [
            'token',
            'name',
            'user_id'
        ];
        $this->table = 'user_groups';
    }
        
    public function findGroupByToken(array $params = [])
    {
        return $this->getByWhere($params, 'name', 'token = :token');
    }
        
    public function getIdByToken(array $params = [])
    {
        return $this->getByWhere($params, 'id', 'token = :token')->fetch()['id'];
    }
            
    public function getGroup(array $params = [])
    {
        $select = 'id, name, token, user_id';
        $where = 'id = :id';
        return $this->getByWhere($params, $select, $where);
    }
}
