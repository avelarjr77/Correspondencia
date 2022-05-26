<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class RolModel extends Model{
    protected $table = 'co_modulo';
    protected $primaryKey = 'moduloId';
    protected $allowedFiels=['nombre'];

    //MODELO PARA LISTAR ROLES
    public function listarRol()
    {
        $wk_rol =  $this->db->query('SELECT*FROM  wk_rol');
        return $wk_rol->getResult();
    }

    public function getMenu($rolId)
    {
        $this->builder()->where('rolId', $rolId);
        return $this;
    }

    //MODELO PARA AGREGAR ROL
    public function insertar($datos){

        $nombreRol = $this->db->table('wk_rol');
        $nombreRol->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $nombres = $this->db->table('wk_rol');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //OBTENER ROLES
    public function obtenerRol($data){
        $nombres = $this->db->table('wk_rol');
        $nombres->where($data);
        return $nombres->get()->getResultArray();
    }

    //Edita el registro en rol
    public function actualizar($data, $rolId){
        $nombres = $this->db->table('wk_rol');
        $nombres->set($data);
        $nombres->where('rolId', $rolId);
        return $nombres->update();
    }


}