<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Group;
use app\Models\User;
use app\Services\Alert;
use app\Services\Validator;

class GroupController implements ViewControllerInterface
{
    public $errors = [];
    public $model;

    public function show(string $alert = '')
    {
        // $group = $this->getMyGroup();
        // return view('group', [
        //     "errors" => $this->errors,
        //     "group" => $group,
        // ], $alert);
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

    public function create()
    {
        if($_SESSION['user_group_id'] === null)
        {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $token = isset($_POST['token']) ? htmlspecialchars($_POST['token']) : '';

            if($token !== '' && $name !== '') {
                if($this->_validate($name, $token) && !$this->_groupExist($token)) {
                    $this->model->add([
                        ':token' => $token,
                        ':name' => $name,
                        ':user_id' => $_SESSION['user_id']
                    ]);
                    $group_id = $this->model->getIdByToken([':token' => $token]);
                    $this->asignUserToGroup($group_id);
                    return $this->showCreate(Alert::success("You have successfully created your own group!"));
                } else {
                    return $this->showCreate(Alert::failed("You are already in group!"));
                }
            }
        } else {
            return $this->showCreate(Alert::failed("You are already in group!"));
        }
    }

    public function join()
    {
        $token = isset($_POST['token']) ? htmlspecialchars($_POST['token']) : '';
        if($_SESSION['user_group_id'] === null)
        {
            if($token !== '') {
                if($this->_groupExist($token) && $_SESSION['user_group_id'] === null) {
                    $group_id = $this->model->getIdByToken([':token' => $token]);
                    $this->asignUserToGroup($group_id);
                    return header('Location: /group');
                }
            }
        }
        return $this->showJoin(Alert::failed("You are already in group."));
    }

    public function quit()
    {
        $id = $_SESSION['user_id'];
        $user = new User;
        $status = $user->quitGroup([':id' => $id]);
        if($status) {
            $_SESSION['user_group_id'] = null;
            return header('Location: /profile');
        }else{
            return $this->show(Alert::failed("Something went wrong."));
        }
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
        $_SESSION['user_group_id']=$group_id;
    }

    public function getMyGroup() : array | false
    {
        $group = false;
        $this->setModel(new Group);
        if($_SESSION['user_group_id'] !== null) {
        $group = $this->model->getGroup([':id' => $_SESSION['user_group_id']])->fetch();
        }

        return $group;
    }

    private function _groupExist(string $token) : bool
    {
        $this->setModel(new Group);
        if($this->model->findGroupByToken([':token' => $token])->rowCount()===1) {
            return true;
        }
        return false;
    }

    private function _validate(string $name, string $token) : bool
    {
        if(!Validator::string($name, 1, 45)) $this->_addError('Nazwa może składać się maksymalnie z 45 znaków.');
        if(!Validator::string($token, 1, 45)) $this->_addError('Token może składać się maksymalnie z 45 znaków.');
        if(empty($this->errors)) return true;
        return false;
    }

    private function _addError(string $error) : void
    {
        array_push($this->errors, $error);
        return;
    }
}
