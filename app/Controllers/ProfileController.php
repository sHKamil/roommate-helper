<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Group;
use app\Models\User;
use app\Services\Alert;
use app\Services\Validator;

class ProfileController implements ViewControllerInterface
{
    private $errors;
    public $model;

    public function show(string $alert = '')
    {
        $avatar = AvatarController::getUserAvatar();
        return view('profile', [
            'errors' => $this->errors,
            'group' => $this->prepareGroupData(),
            'avatar_path' => $avatar
        ], $alert);
    }

    public function prepareGroupData() : array |false
    {
        $group_controller = new GroupController;
        $rows = $group_controller->getMyGroup();
        
        return $rows;
    }

    public function update()
    {
        $user_name = isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : '';
        $user_lastname = isset($_POST['user_lastname']) ? htmlspecialchars($_POST['user_lastname']) : '';
        $user_email = isset($_POST['user_email']) ? htmlspecialchars($_POST['user_email']) : '';
        if($this->validateInputs($user_name, $user_lastname)) {
            if(isset($_FILES)) {
                $avatar = new UploadController;
                $avatar->upload();
                if(!empty($avatar->errors)) {
                    return $this->show(Alert::failed('Image size or format error! (only 100x100px with extensions jpeg and png are allowed')); // just for now
                }
            }
            $user = new User;
            if($user->updateById([
                ':id' => $_SESSION['user_id'],
                ':user_name' => $user_name,
                ':user_lastname' => $user_lastname,
                ':user_email' => $user_email
            ])) {
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_lastname'] = $user_lastname;
                $_SESSION['user_email'] = $user_email;
                return $this->show(Alert::success("You have successfully updated your profile!"));        
            }    
        }
        return $this->show(Alert::failed("Something went wrong!"));

    }

    private function validateInputs($user_name, $user_lastname)
    {      
            if(!Validator::string($user_name, 1, 15)) $this->errors['user_name'] = 'Imię może mieć maksymalnie 15 znaków.';
            if(!Validator::string($user_lastname, 1, 40)) $this->errors['user_name'] = 'Nazwisko może posiadać maksymalnie 40 znaków';
           
            if (!empty($this->errors)) return $this->show(Alert::failed('Error', ''));

            if (!empty($this->errors)) return $this->show(Alert::failed('Error', ''));
        return true;
    }
}
