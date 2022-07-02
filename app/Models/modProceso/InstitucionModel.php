<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class InstitucionModel extends Model{

    protected $table = 'wk_institucion';
    protected $primaryKey = 'institucionId';
    protected $allowedFields = ['institucionId', 'nombreInstitucion'];

    //MODELO PARA LISTAR ROLES
    public function listarInstitucion()
    {
        return $this->asObject()
        ->select("*")
        ->orderBy('wk_institucion.institucionId')
        ->findAll();
    }

    //MODELO PARA AGREGAR ROL
    public function insertar($datos){

        $nombreInstitucion = $this->db->table('wk_institucion');
        $nombreInstitucion->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $nombres = $this->db->table('wk_institucion');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en rol
    public function actualizar($data, $institucionId){
        $nombres = $this->db->table('wk_institucion');
        $nombres->set($data);
        $nombres->where('institucionId', $institucionId);
        return $nombres->update();
    }
}