<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class RolModel extends Model{

    protected $table = 'wk_rol';
    protected $primaryKey = 'rolId';
    protected $allowedFields = ['rolId', 'nombreRol'];

    //MODELO PARA LISTAR ROLES
    public function listarRol()
    {
        return $this->asObject()
        ->select("*")
        ->orderBy('wk_rol.rolId')
        ->findAll();
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

    //Edita el registro en rol
    public function actualizar($data, $rolId){
        $nombres = $this->db->table('wk_rol');
        $nombres->set($data);
        $nombres->where('rolId', $rolId);
        return $nombres->update();
    }


}