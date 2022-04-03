<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuSubmenuModel extends Model
{

    public function listarMenu()
    {
        $co_menu = $this->db->query('SELECT*FROM co_menu');
        return $co_menu->getResult();
    }

    public function insertar($datos)
    {
        $nombreMenu = $this->db->table('co_menu');
        $nombreMenu->insert($datos);

        return $this->db->insertID();
    }
    public function obtenerNombre($data)
    {
        $nombreMenu = $this->db->table('co_menu');
        $nombreMenu->where($data);
        return $nombreMenu->get()->getResultArray();
    }

    public function eliminar($data){
        $nombreMenu = $this->db->table('co_menu');
        $nombreMenu->where($data);
        return $nombreMenu->delete();
    }
    public function listarSubmenu()
    {
        $co_submenu = $this->db->query('SELECT*FROM co_submenu');
        return $co_submenu->getResult();
    }

    public function crearSubmenu($datos)
    {
        $nombreSubMenu = $this->db->table('co_submenu');
        $nombreSubMenu->insert($datos);
    }

}
