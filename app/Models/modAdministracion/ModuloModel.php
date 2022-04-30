<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class ModuloModel extends Model{
    protected $table = 'co_modulo';
    protected $primaryKey = 'moduloId';
    protected $allowedFiels=['nombre'];

    //MODELO PARA LISTAR MODULOS
    public function listarModulo()
    {
        $Modulo =  $this->db->query('SELECT*FROM  co_modulo');
        return $Modulo->getResult();
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

    //OBTENER ROLES
    public function obtenerModulo($data){
        $Modulo = $this->db->table('co_modulo');
        $Modulo->where($data);
        return $Modulo->get()->getResultArray();
    }

    //Edita el registro en MODULO
    public function actualizarModulo($data, $moduloId){
        $Modulo = $this->db->table('co_modulo');
        $Modulo->set($data);
        $Modulo->where('moduloId', $moduloId);
        return $Modulo->update();
    }
    

}