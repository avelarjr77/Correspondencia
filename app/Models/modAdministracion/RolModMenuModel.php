<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class RolModMenuModel extends Model
{
    protected $table = 'co_rol_modulo_menu';
    protected $primaryKey = 'rolModuloMenuId';

    public function get($rolModuloMenu = null)
    {
        
        return $this->asArray()
        ->select('co_rol_modulo_menu.rolModuloMenuId, wk_rol.nombreRol as rol, co_modulo.nombre as modulo')
        ->join('wk_rol', 'co_rol_modulo_menu.rolId = wk_rol.rolId')
        ->join('co_modulo_menu', 'co_rol_modulo_menu.moduloMenuId = co_modulo_menu.moduloMenuId')
        ->join('co_modulo', 'co_rol_modulo_menu.moduloId= co_modulo.rolId')
        ->where(['rolModuloMenu' => $rolModuloMenu])
        ->first();
    }

}