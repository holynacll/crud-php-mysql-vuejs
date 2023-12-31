<?php

namespace App\Models;

require __DIR__.'/../../vendor/autoload.php';

use App\Database\Database;
use \PDO;

class Address
{
    CONST TABLE_NAME = 'addresses';
    protected $logradouro;
    protected $bairro;
    protected $cep;
    protected $active;
    protected $user_id;

    public static function find($id)
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->select('id = '.$id)
                            ->fetchObject(self::class);

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
            'logradouro' => $this->getLogradouro(),
            'bairro' => $this->getBairro(),
            'cep' => $this->getCep(),
            'active' => $this->getActive(),
            'user_id' => $this->getUserId(),
        ]);

        return $result;
    }

    public function update($where = null)
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->update($where, [
            'logradouro' => $this->getLogradouro(),
            'bairro' => $this->getBairro(),
            'cep' => $this->getCep(),
            'active' => $this->getActive(),
            'user_id' => $this->getUserId(),
        ]);

        return $result;
    }

    /**
     * Atualiza os demais endereços do usuario para inativo, exceto o ultimo ativado
     */
    public function updateInactiveAddresses($where = null)
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->update($where, [
            'active' => 0,
        ]);

        return $result;
    }

    public function delete()
    {
        $database = new Database(self::TABLE_NAME);
        $result = $database->delete('id = '.$this->id);
        return $result;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }
    
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setCep($cep)
    {
        $this->cep = preg_replace("/[^0-9]/", '', $cep);
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }
    
    public function getBairro()
    {
        return $this->bairro;
    }
    
    public function getCep()
    {
        return $this->cep;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getActive()
    {
        return $this->active;
    }
}