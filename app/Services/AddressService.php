<?php

namespace App\Services;

use App\Models\Address;

class AddressService 
{
    public static function find($id)
    {
        if(!isset($id) or !is_numeric($id)) {
            header('location: index.php?status=error');
            exit;
        }
        $address = Address::find($id);
        if(isset($address)) return $address;

        header('location: index.php?status=error');
        exit;
    }

    public static function getManyByUserIdSortedByUpdatedAt($id)
    {
        return Address::all('user_id = '.$id, 'id desc',  null, '*');
    }

    public static function create($data)
    {
        $data = json_decode(array_key_first($data), true)['address'];
        if(isset($data['logradouro'], $data['bairro'], $data['cep'], $data['active'])) {
            $address = new Address;
            $address->setLogradouro($data['logradouro']);
            $address->setBairro($data['bairro']);
            $address->setCep($data['cep']);
            $address->setActive($data['active']);
            $address->setUserId($data['user_id']);
            $result = $address->save();
            if(isset($result) && $address->getActive()) {
                $address->updateInactiveAddresses("(id != $result and user_id = ".$data['user_id'].")");
            }
            return $result;
        }
        return null;
    }

    public static function update($data)
    {
        $data = json_decode(array_key_first($data), true)['address'];
        if(isset($data['logradouro'], $data['bairro'], $data['cep'])) {
            $address = self::find($data['id']);
            $address->setLogradouro($data['logradouro']);
            $address->setBairro($data['bairro']);
            $address->setCep($data['cep']);
            $address->setActive($data['active']);
            $address->setUserId($data['user_id']);
            $result = $address->update('id = '.$data['id']);
            if($address->getActive()) {
                $address->updateInactiveAddresses('(id != '.$data['id'].' and user_id = '.$data['user_id'].')');
            }
            return $result;
        }
        return null;
    }

    public static function delete($data)
    {
        $data = json_decode(array_key_first($data), true)['address'];
        if(isset($data['id'])) {
            $address = self::find($data['id']);
            $result = $address->delete();
            return $result;
        }
        return null;
    }
}