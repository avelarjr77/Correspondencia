<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class ModuloMenuModel extends Model{

    protected $table = 'co_modulo_menu';
    protected $primaryKey = 'moduloMenuId';
    protected $allowedFields = ['moduloMenuId', 'moduloId', 'menuId'];

    //MODELO PARA LISTAR MODULOS MENUS
    public function listarModuloMenu()
    {
        $ModuloMenu = $this->db->query('SELECT*FROM co_modulo_menu');
        return $ModuloMenu->getResult();
    }

    //MODELO PARA AGREGAR MODULOS MENUS
    public function insertar($datos){

        $ModuloMenu = $this->db->table('co_modulo_menu');
        $ModuloMenu->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $ModuloMenu = $this->db->table('co_modulo_menu');
        $ModuloMenu->where($data);
        return $ModuloMenu->delete();
    }

    //Edita el registro en MODULO MENUS
    public function actualizar($data, $moduloMenuId){
        $Modulo = $this->db->table('co_modulo_menu');
        $Modulo->set($data);
        $Modulo->where('moduloMenuId', $moduloMenuId);
        return $Modulo->update();
    }
    

}