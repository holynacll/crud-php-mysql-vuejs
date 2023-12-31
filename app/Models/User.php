<?php

namespace App\Models;

require __DIR__.'/../../vendor/autoload.php';

use App\Database\Database;
use \PDO;

class User
{
    CONST TABLE_NAME = 'users';
    protected $id;
    protected $name;
    protected $cpf;
    protected $sex;
    protected $active;
    protected $created_at;
    protected $updated_at;

    public static function find($id)
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->select('id = '.$id)
                            ->fetchObject(self::class);
        return $result;
    }

    public static function findOne($id)
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->select('users.id = '.$id)
                            ->fetchObject();

        return $result;
    }

    public static function all($where = null, $order = null, $limit = null, $fields = '*', $joins = null)
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->select($where, $order, $limit, $fields, $joins)
                            ->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    public function save()
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->insert([
            'name' => $this->getName(),
            'cpf' => $this->getCpf(),
            'sex' => $this->getSex(),
        ]);

        return $result;
    }

    public function update()
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->update('id = '.$this->id,[
            'name' => $this->getName(),
            'cpf' => $this->getCpf(),
            'sex' => $this->getSex(),
        ]);

        return $result;
    }

    public function delete()
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->delete('id = '.$this->id);
        return $result;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getCpf()
    {
        return $this->cpf;
    }
    
    public function getSex()
    {
        return $this->sex;
    }
}