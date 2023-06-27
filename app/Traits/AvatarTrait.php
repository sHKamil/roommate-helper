<?php

namespace app\Traits;

trait AvatarTrait {
    public static function makeAvatarName() : string
    {
        // Create name with actual user id for the avatar file without extension
        $user_id = $_SESSION['user_id'];
        $avatarName = $user_id . '_avatar';

        return $avatarName;
    }
}