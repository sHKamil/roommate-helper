<?php

namespace app\Services;

use app\Database\Database;
use app\Database\DatabasePDO;

class Validator
{

    public static function date($string) : bool
    {
        \DateTime::createFromFormat('Y-m-d', $string);
        $errors = \DateTime::getLastErrors();
        if ($errors['error_count'] === 0 && $errors['warning_count'] === 0) return true;
        return false;
    }

    public static function string($string, $min = 1, $max = 255) : bool
    {
        $string = trim($string);
        return strlen($string) >= $min && strlen($string) <= $max;
    }

    public static function containNumber($string) : bool
    {
        if (!preg_match('/[0-9]/', $string)) {
            return true;
        }
        return false;
    }

    public static function containSpecialCharacter($string) : bool
    {
        if (!preg_match('/[^a-zA-Z0-9]/', $string)) {
            return true;
        }
        return false;
    }

    public static function imgType($string) : bool
    {
        $allowedFileTypes = ['image/png', 'image/jpeg'];
        if (in_array($string, $allowedFileTypes)) return true;
        return false;
    }

    public static function propperImgSize($file_tmp, $width = 100, $height = 100) : bool
    {
        $img_info = getimagesize($file_tmp);
        if($width === $img_info[0] && $height === $img_info[1]) return true;
        return false;
    }

    public static function isNotDoubled($table, $row, $param) : bool
    {
        $db = new DatabasePDO;
        $result = $db->query('SELECT id FROM ' . $table . ' WHERE ' . $row . ' = :param ', $param);
        if($result->rowCount() === 0) return true;

        return false;
    }

    public static function validateCSRF($token) : bool
    {
        return $token === $_SESSION['csrf_token'] && $token === $_POST['csrf_token'];
    }

    public static function sessionClientIP() : bool
    {    
        if ($_SESSION['client_ip'] !== $_SERVER['REMOTE_ADDR']) {
            return false;
        }
 
        return true;
    }

    
}
