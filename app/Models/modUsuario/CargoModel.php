<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class CargoModel extends Model{

    protected $table = 'wk_cargo';
    protected $primaryKey = 'cargoId';
    protected $allowedFields = ['cargoId', 'cargo'];


    //MODELO PARA LISTAR ROLES
    public function listarCargo()
    {
        $cargo =  $this->db->query('SELECT*FROM  wk_cargo');
        return $cargo->getResult();
    }


    //MODELO PARA AGREGAR ROL
    public function insertar($datos){

        $nombreCargo = $this->db->table('wk_cargo');
        $nombreCargo->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $nombres = $this->db->table('wk_cargo');
        $nombres->where($data);
        return $nombres->delete();
    }

    //Edita el registro en rol
    public function actualizar($data, $cargoId){
        $nombres = $this->db->table('wk_cargo');
        $nombres->set($data);
        $nombres->where('cargoId', $cargoId);
        return $nombres->update();
    }


}