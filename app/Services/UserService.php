<?php

namespace App\Services;

use App\Models\User;

class UserService 
{
    public static function find($id)
    {
        if(!isset($id) or !is_numeric($id)) {
            header('location: index.php?status=error');
            exit;
        }
        $user = User::find($id);
        if(isset($user)) return $user;

        header('location: index.php?status=error');
        exit;
    }

    public static function getManySortedByUpdatedAt()
    {
        return User::all(null, 'users.updated_at desc', null, 
        'users.*, 
        addresses.logradouro, 
        addresses.cep,
        addresses.bairro',
        'left join addresses on addresses.user_id = users.id and addresses.active = 1');
    }

    public static function create($data)
    {
        $data = json_decode(array_key_first($data), true)['user'];
        if(isset($data['name'], $data['cpf'], $data['sex'])) {
            $user = new User;
            $user->setName($data['name']);
            $user->setCpf($data['cpf']);
            $user->setSex($data['sex']);
            $result = $user->save();
            return $result;
        }
        return null;
    }

    public static function update($data)
    {
        $data = json_decode(array_key_first($data), true)['user'];
        if(isset($data['name'], $data['cpf'], $data['sex'])) {
            $user = self::find($data['id']);
            $user->setName($data['name']);
            $user->setCpf($data['cpf']);
            $user->setSex($data['sex']);
            $result = $user->update();
            return $result;
        }
        return null;
    }

    public static function delete($data)
    {
        $data = json_decode(array_key_first($data), true)['user'];
        if(isset($data['id'])) {
            $user = self::find($data['id']);
            $result = $user->delete();
            return $result;
        }
        return null;
    }
}