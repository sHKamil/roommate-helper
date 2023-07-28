<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Event;
use app\Models\User;
use app\Services\Alert;
use app\Services\Validator;

class EventController implements ViewControllerInterface
{
    public $errors = [];
    public $model;

    public function show(string $alert = '')
    {
        $table = $this->prepareTable();
        return view('event', [
            "errors" => $this->errors,
            "table" => $table
        ], $alert);
    }
    
    public function showEdit(string $alert = '')
    {
        $this->setModel(new Event);
        $id = $_POST['id_edit'];
        $data = $this->model->getEventByGroupIdAndId([
            ':id' => $id,
            ':group_id' => $_SESSION['user_group_id']
        ]);
        $user = new User;
        $last_user = $user->getUserNameById([':id' => $data['user_id']]); // get username of user that lastly edited that record
        return view('event-edit', [
            "errors" => $this->errors,
            "data" => $data,
            "last_user" => $last_user['name']
        ], $alert);
    }

    public function create()
    {
        if($_SESSION['user_group_id'] !== null)
        {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null;
            $day = isset($_POST['day']) ? htmlspecialchars($_POST['day']) : null;
            $start = isset($_POST['start']) ? htmlspecialchars($_POST['start']) : null;
            $end = isset($_POST['end']) ? htmlspecialchars($_POST['end']) : null;

            if($this->_validate($name, $content, $day, $start, $end)) {
                $this->setModel(new Event);
                if($this->model->add([
                        ':group_id' => $_SESSION['user_group_id'],
                        ':user_id' => $_SESSION['user_id'],
                        ':event_name' => $name,
                        ':content' => $content,
                        ':day' => $day,
                        ':start' => $start,
                        ':end' => $end
                    ])) return $this->show(Alert::success("You have successfully added a new item!"));
                return $this->show(Alert::failed("Something went wrong"));
            }
            return $this->show(Alert::failed("Something went wrong"));
        } else {
            return header('Location: /group-create');
        }
    }

    public function update()
    {
        if($_SESSION['user_group_id'] !== null)
        {
            $name = isset($_POST['event_name']) ? htmlspecialchars($_POST['event_name']) : '';
            $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null;
            $day = isset($_POST['day']) ? htmlspecialchars($_POST['day']) : null;
            $start = isset($_POST['start']) ? htmlspecialchars($_POST['start']) : null;
            $end = isset($_POST['end']) ? htmlspecialchars($_POST['end']) : null;

            if($this->_validate($name, $content, $day, $start, $end)) {                
                $this->setModel(new Event);
                if($this->model->updateByIdAndGroupId([
                    ':id' => $_POST['id'],
                    ':group_id' => $_SESSION['user_group_id'],
                    ':user_id' => $_SESSION['user_id'],
                    ':event_name' => $name,
                    ':content' => $content,
                    ':day' => $day,
                    ':start' => $start,
                    ':end' => $end
                ],
                'user_id = :user_id, event_name = :event_name, content = :content, day = :day, start = :start, end = :end'
                )) return $this->show(Alert::success("You have successfully updated an item!"));
                return $this->show(Alert::failed("Something went wrong"));
            }
            return $this->show(Alert::failed("Something went wrong"));
        } else {
            return header('Location: /group-create');
        }
    }

    public function delete()
    {
        $id = [];
        foreach ($_POST['id'] as $post_id) {
            $raw_id = isset($post_id) ? htmlspecialchars($post_id) : '';
            array_push($id, $raw_id);
        }
        $this->setModel(new Event);
        if($this->_deleteByID($id)) return $this->show(Alert::success("You have successfully deleted an item!"));
    }

    private function _deleteByID(array $id = []) : bool // deletes form db selected supplies from group
    {
        foreach ($id as $event_id) {
            if($this->model->deleteByGroupIdAndId([
                ':id' => $event_id,
                ':group_id' => $_SESSION['user_group_id']
            ]) === false) return false;
        }
        return true;
    }

    public function setModel(Event $event) : void
    {
        $this->model = $event;
        return;
    }

    public function prepareTable() : string
    {
        $threads = [
            'Select',
            'ID',
            'Event name',
            'Content',
            'Day',
            'Start',
            'End'
        ];
        $this->setModel(new Event);
        $rows = $this->model->getEventsByGroupID([':group_id' => $_SESSION['user_group_id']]);
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
                <td>
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
            <input type='hidden' name='id_edit' value=$id>
            <input id='edit' type='submit' class='btns btn__secondary' name='_method' value='edit'>
        </form>
        ";
        return $form;
    }

    private function _validate(string $name, string $content, string $day, $start, $end) : bool
    {
        if(!Validator::string($name, 1, 30)) $this->_addError('Name can only contain 1-30 characters.');
        if(!Validator::string($content)) $this->_addError('Content can only contain 1-255 characters.');
        if(!Validator::date($day)) $this->_addError('Wrong date format.');

        $start = strtotime($start);
        $end = strtotime($end);
        if($start > $end) $this->_addError('Start cannot be greater than end.');
        if(empty($this->errors)) return true;
        return false;
    }
    
    private function _addError(string $error) : void
    {
        array_push($this->errors, $error);
        return;
    }
}
