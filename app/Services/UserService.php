<?php

namespace App\Services;

use App\Models\User;

class UserService 
{
    public static function find($id)
    {
        if(!isset($id) or !is_numeric($id)) {
            // header('location: index.php?status=error');
            var_dump($id);
            exit;
        }

        $user = User::find($id);

        if(isset($user)) return $user;
        // header('location: index.php?status=error');
        exit;
    }

    public static function getMany()
    {
        $users = User::all();
        return $users;
    }
}