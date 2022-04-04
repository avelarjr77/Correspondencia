<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class ModuloModel extends Model
{
    protected $table = "co_modulo";

    protected $primaryKey = 'moduloId';

    protected $useAutoIncrement = true;

    public function get($moduloId = null)
    {
        if ($moduloId === null) {
            return $this->findAll();
        }

        return $this->asArray()
        ->where(['moduloId' => $moduloId])
        ->first();
    }
}