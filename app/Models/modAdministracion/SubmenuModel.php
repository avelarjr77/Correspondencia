<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table      = 'co_submenu';
    protected $primaryKey = 'subMenuId';
    protected $allowedFiels=['menuId','nombreSubMenu', 'nombreArchivo'];

    public function crearSubmenu($datos)
    {
        $nombreSubMenu = $this->db->table('co_submenu');
        $nombreSubMenu->insert($datos);

        return $this->db->insertID();
    }
    public function eliminar($data){
        $MenuSubmenu = $this->db->table('co_submenu');
        $MenuSubmenu->where($data);
        return $MenuSubmenu->delete();
    }

    //Edita el registro en menu
    public function actualizarSubmenu($data, $subMenuId){
        $MenuSubmenu = $this->db->table('co_submenu');
        $MenuSubmenu->set($data);
        $MenuSubmenu->where('subMenuId', $subMenuId);
        return $MenuSubmenu->update();
    }
}