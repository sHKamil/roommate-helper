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
        $table = $this->prepareTable();
        return view('supply', [
            "errors" => $this->errors,
            "table" => $table
        ], $alert);
    }

    public function showCreate(string $alert = '')
    {
        return view('supply-create', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showEdit(string $alert = '')
    {
        $this->setModel(new Supply);
        $id = $_POST['id_edit'];
        $data = $this->model->getSupplyByGroupIdAndId([
            ':id' => $id,
            ':group_id' => $_SESSION['user_group_id']
        ]);
        $user = new User;
        $last_user = $user->getUserNameById([':id' => $data['user_id']]); // get username of user that lastly edited that record
        return view('supply-edit', [
            "errors" => $this->errors,
            "data" => $data,
            "last_user" => $last_user['name']
        ], $alert);
    }

    public function update()
    {
        if($_SESSION['user_group_id'] !== null)
        {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $quantity_max = isset($_POST['quantity_max']) ? htmlspecialchars($_POST['quantity_max']) : '';
            $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';
            $days_until_ends = isset($_POST['days_until_ends']) ? htmlspecialchars($_POST['days_until_ends']) : '';

            if($this->_validate($name, $quantity_max, $quantity, $days_until_ends)) {
                $days_until_ends = $days_until_ends ? '' : 0;
                $expected_end = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $days_until_ends . ' days'));
                $datatime = date("Y-m-d H:i:s");
                $this->setModel(new Supply);
                if($this->model->updateById([
                        ':id' => $_POST['id'],
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

    public function create()
    {
        if($_SESSION['user_group_id'] !== null)
        {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $quantity_max = isset($_POST['quantity_max']) ? htmlspecialchars($_POST['quantity_max']) : null;
            $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : null;
            $days_until_ends = isset($_POST['days_until_ends']) ? htmlspecialchars($_POST['days_until_ends']) : null;

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
        foreach ($_POST['id'] as $post_id) {
            $raw_id = isset($post_id) ? htmlspecialchars($post_id) : '';
            array_push($id, $raw_id);
        }
        $this->setModel(new Supply);
        if($this->_deleteByID($id)) return $this->show(Alert::success("You have successfully deleted an item!"));
    }
                
    public function setModel(Supply $supply) : void
    {
        $this->model = $supply;
        return;
    }

    public function prepareTable() : string
    {
        $threads = [
            'Select',
            'ID',
            'Name',
            'Quantity',
            'Quantity max',
            'Expected end',
            'Last check'
        ];
        $this->setModel(new Supply);
        $rows = $this->model->getSuppliesByGroupID([':group_id' => $_SESSION['user_group_id']]);
        $html = "
        <table class='table' style='text-align:center;>
            <tr scope='col' style='text-align:center;'>
        ";
        foreach ($threads as $column) {
            $html .= "<th>$column</th>
            ";
        }
        $html .= "</tr>
            ";
        foreach ($rows as $row) {
            $html .= "<tr>
                <td class='checkbox'>
                        <input class='_checkbox' type='checkbox' name='id[]' value={$row['id']}>
                </td>
            ";
            foreach ($row as $column) {
                $html .= "  <td scope='row'>$column</td>
            ";
            }
            $html .= "
                <td>" . $this->_addHTMLEditForm($row['id']) . "</td>
            </tr>
            ";
        }
        $html .= "
        </table>";
        return $html;
    }

    private function _addHTMLEditForm($id) : string
    {
        $form = "
        <form method='POST'>
            <input type='hidden' name='_method' value='edit'>
            <input type='hidden' name='id_edit' value=$id>
            <input id='edit' type='submit' class='btns btn__secondary' value='edit'>
        </form>
        ";
        return $form;
    }

    private function _deleteByID(array $id = []) : bool // deletes form db selected supplies from group
    {
        foreach ($id as $supply_id) {
            if($this->model->deleteByGroupIdAndId([
                ':id' => $supply_id,
                ':group_id' => $_SESSION['user_group_id']
            ]) === false) return false;
        }
        return true;
    }

    private function _validate(string $name, int $quantity_max, int $quantity, $days_until_ends) : bool
    {
        $days_until_ends = intval($days_until_ends);
        if(!Validator::string($name, 1, 45)) $this->_addError('Name is too short or too long (min 1 and max 45 char)');
        if(!is_int($quantity) || !is_int($quantity_max) || !is_int($days_until_ends)) {
            $this->_addError('You need to use intiger in fields: Quantity, Quantity max, Days until ends');
        } else {
            if($quantity > $quantity_max) $this->_addError('Actual quantity cannot be greater than the max quantity');
        }
        if(empty($this->errors)) return true;
        return false;
    }

    private function _addError(string $error) : void
    {
        array_push($this->errors, $error);
        return;
    }
}
