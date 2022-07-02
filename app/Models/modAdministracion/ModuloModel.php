<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class ModuloModel extends Model{

    protected $table = 'co_modulo';
    protected $primaryKey = 'moduloId';
    protected $allowedFields = ['moduloId', 'nombre'];

    //MODELO PARA LISTAR MODULOS
    public function listarModulo()
    {
        return $this->asObject()
        ->select("*")
        ->orderBy('co_modulo.moduloId')
        ->findAll();
        
    }

    //MODELO PARA AGREGAR MODULOS
    public function insertar($datos){

        $Modulo = $this->db->table('co_modulo');
        $Modulo->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $Modulo = $this->db->table('co_modulo');
        $Modulo->where($data);
        return $Modulo->delete();
    }

    //Edita el registro en MODULO
    public function actualizarModulo($data, $moduloId){
        $Modulo = $this->db->table('co_modulo');
        $Modulo->set($data);
        $Modulo->where('moduloId', $moduloId);
        return $Modulo->update();
    }
    

}