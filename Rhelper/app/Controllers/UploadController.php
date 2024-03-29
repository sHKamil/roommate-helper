<?php

namespace app\Controllers;

use app\Controllers\EditionController;
use app\Models\User;
use app\Service\Alert;
use app\Services\Validator;
use app\Traits\AvatarTrait;

class UploadController
{
    use AvatarTrait;

    private $img;
    private $img_name;
    private $destination;
    private $user;
    public $errors;

    public function upload() : bool
    {
        if ($this->_validateImage()) {
            $user = new User;
            if($user -> updateAvatarById([
                ':id' => $_SESSION['user_id'],
                ':avatar' => $this->img_name
                ])) {
                    move_uploaded_file($this->img['tmp_name'], $this->destination);
                    $_SESSION['user_avatar'] = $this->img_name;
                    return true;
            }
        }
        return false;
    }

    
    private function _setImgAttributes() : void
    {
        $this->img = $_FILES['file'];
        $this->img_name = self::makeAvatarName() . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $this->destination = 'avatars/' . $this->img_name;
        return;
    }

    private function _validateImage() : bool
    {
        if (!empty($_FILES['file']['tmp_name'])) {
            $this->_setImgAttributes();
            try
            {
                if(Validator::imgType($this->img['type']) === false) $this->errors['img_type'] = "Wrong file type. (Only png and jpg are allowed).";
                if(Validator::propperImgSize($this->img['tmp_name']) === false) $this->errors['img_size'] = "Wrong image sizing. (Avatar must be 100x100px).";
            } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            if(empty($this->errors)) return true;
        }
        return false;
    }
}
