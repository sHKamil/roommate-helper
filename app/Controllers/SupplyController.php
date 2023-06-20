<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Supply;
use app\Models\User;
use app\Services\Alert;
use app\Services\Validator;

class SupplyController implements ViewControllerInterface
{
    public $errors = [];
    public $model;

    public function show(string $alert = '')
    {
        return view('supply', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showCreate(string $alert = '')
    {
        return view('supply-create', [
            "errors" => $this->errors
        ], $alert);
    }

    public function create()
    {
        if($_SESSION['user_group_id'] !== null)
        {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $quantity_max = isset($_POST['quantity_max']) ? htmlspecialchars($_POST['quantity_max']) : '';
            $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';
            $days_until_ends = isset($_POST['days_until_ends']) ? htmlspecialchars($_POST['days_until_ends']) : '';

            if($this->_validate($name, $quantity_max, $quantity, $days_until_ends)) {
                $expected_end = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $days_until_ends . ' days'));
                $datatime = date("Y-m-d H:i:s");
                $this->setModel(new Supply);
                if($this->model->addSupply([
                        ':group_id' => $_SESSION['user_group_id'],
                        ':user_id' => $_SESSION['user_id'],
                        ':name' => $name,
                        ':quantity_max' => $quantity_max,
                        ':quantity' => $quantity,
                        ':expected_end' => $expected_end,
                        ':last_check' => $datatime
                    ])) return $this->show(Alert::success("You have successfully added a new item!"));
                return $this->show(Alert::failed("Something went wrong"));
            }
            return $this->show(Alert::failed("Something went wrong"));
        } else {
            return header('Location: /group/create');
        }
    }

    public function delete()
    {
        $id = [];
        foreach ($_POST['id'] as $id) {
            $raw_id = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            array_push($id, $raw_id);
        }
        if($this->_deleteByID($id)) return $this->show(Alert::success("You have successfully deleted an item!"));
    }
                
    public function setModel(Supply $supply) : void
    {
        $this->model = $supply;
        return;
    }

    private function _deleteByID(array $id = []) : bool // deletes form db selected supplies from group
    {
        foreach ($id as $supply_id) {
            if($this->model->deleteByGroupIdAndId([
                ':id' => $supply_id,
                ':group_id' => $_SESSION['group_id']
            ]) === false) return false;
        }
        return true;
    }

    private function _validate(string $name, int $quantity_max, int $quantity, int $days_until_ends) : bool
    {
        if(!Validator::string($name, 1, 45)) $this->_addError('Name is too short or too long (min 1 and max 45 char)');
        if(!is_int($quantity_max) || !is_int($quantity) || !is_int($days_until_ends)) $this->_addError('You need to use intiger in fields: Quantity, Quantity max, Days until ends');
        if(empty($this->errors)) return true;
        return false;
    }

    private function _addError(string $error) : void
    {
        array_push($this->errors, $error);
        return;
    }
}
