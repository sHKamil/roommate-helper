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
        if($_SESSION['user_group_id'] === null)
        {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $token = isset($_POST['token']) ? htmlspecialchars($_POST['token']) : '';

            if($token !== '' && $name !== '') {
                if($this->_validate($name, $token) && !$this->_groupExist($token)) {
                    $this->model->addGroup([
                        ':token' => $token,
                        ':name' => $name,
                        ':user_id' => $_SESSION['user_id']
                    ]);
                    $group_id = $this->model->getIdByToken([':token' => $token]);
                    $this->asignUserToGroup($group_id);
                    return $this->showCreate(Alert::success("You have successfully created your own group!"));
                }
            }
        } else {
            return $this->showCreate(Alert::failed("You are already in group!"));
        }
    }
                
    public function setModel(Supply $supply) : void
    {
        $this->model = $supply;
        return;
    }

    private function _validate(string $name, string $token) : bool
    {

        return false;
    }

    private function _addError(string $error) : void
    {
        array_push($this->errors, $error);
        return;
    }
}
