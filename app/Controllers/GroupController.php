<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Group;
use app\Models\User;

class GroupController implements ViewControllerInterface
{
    public $errors;
    public $model;

    public function show(string $alert = '')
    {
        return view('group', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showCreate(string $alert = '')
    {
        return view('group-create', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showJoin(string $alert = '')
    {
        return view('group-join', [
            "errors" => $this->errors
        ], $alert);
    }

    public function join()
    {
        $token = isset($_POST['token']) ? htmlspecialchars($_POST['token']) : '';
        if($token !== '') {
            if($this->_groupExist($token)) {
                $group_id = $this->model->getIdByToken([':token' => $token]);
                $this->asignUserToGroup($group_id);
            }
        }
    }

    public function quit()
    {
        // update group_id row in users table (set to null)
    }
                
    public function setModel(Group $group) : void
    {
        $this->model = $group;
        return;
    }

    public function asignUserToGroup($group_id) : void
    {
        $user = new User;
        $user->asign([
            ':group_id' => $group_id,
            ':id' => $_SESSION['user_id']
        ]);
    }

    private function _groupExist($token) : bool
    {
        $this->setModel(new Group);
        if($this->model->findGroupByToken($token)->rowCount()===1) {
            return true;
        }
        return false;
    }
}
