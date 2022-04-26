<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class DepartamentoModel extends Model{

    //MODELO PARA LISTAR ROLES
    public function listarDepartamento()
    {
        $departamento =  $this->db->query('SELECT*FROM  wk_departamento');
        return $departamento->getResult();
    }


    //MODELO PARA AGREGAR ROL
    public function insertar($datos){

        $nombreDepartamento = $this->db->table('wk_departamento');
        $nombreDepartamento->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $nombres = $this->db->table('wk_departamento');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en rol
    public function actualizar($data, $departamentoId){
        $nombres = $this->db->table('wk_departamento');
        $nombres->set($data);
        $nombres->where('departamentoId', $departamentoId);
        return $nombres->update();
    }


}