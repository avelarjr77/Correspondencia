<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    public function listarMenu()
    {
        $co_menu = $this->db->query('SELECT*FROM co_menu');
        return $co_menu->getResult();
    }

    public function listarSubMenu()
    {
        $submenu = $this->db->query('SELECT*FROM co_submenu');
        return $submenu->getResult();
    }
    
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