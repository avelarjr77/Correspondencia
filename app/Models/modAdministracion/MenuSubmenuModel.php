<?php

namespace App\Models\modAdministracion;

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

    //Obtenemos el registro a editar
    public function editar($data){
        $nombreMenu = $this->db->table('co_menu');
        $nombreMenu->where($data);
        return $nombreMenu->get()->getResultArray();
    }

    //Edita el registro en menu
    public function actualizar($data, $menuId){
        $nombreMenu = $this->db->table('co_menu');
        $nombreMenu->set($data);
        $nombreMenu->where('menuId', $menuId);
        return $nombreMenu->update();
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