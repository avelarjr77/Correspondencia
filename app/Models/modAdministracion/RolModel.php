<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = "wk_rol";

    protected $primaryKey = 'rolId';

    protected $useAutoIncrement = true;

    public function get($rolId = null)
    {
        if ($rolId === null) {
            return $this->findAll();
        }

        return $this->asArray()
        ->where(['rolId' => $rolId])
        ->first();
    }
}