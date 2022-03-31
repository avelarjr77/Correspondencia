<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Models;

class RolModMenuModel extends Model
{
    protected $table = 'co_rol_modulo_menu';
    protected $primaryKey = 'rolModuloMenuId';

    public function get($rolModuloMenu = null)
    {
        if ($rolModuloMenu === null){
            return $this->findAll();
        }

        return $this->asArray()
        ->where(['rolModuloMenu' => $rolModuloMenu])
        ->first();
    }

}