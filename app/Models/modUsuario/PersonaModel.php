<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class PersonaModel extends Model{

   
    //LISTADO DE PERSONAS
    public function listarPersona()
    {
        $persona =  $this->db->query('SELECT*FROM  wk_persona');
        return $persona->getResult();
    }

    //LISTADO DE MUNICIPIO
    public function listarMunicipio()
    {
        $municipio =  $this->db->query('SELECT*FROM  wk_municipio');
        return $municipio->getResult();
    }

    //MODELO PARA AGREGAR DIRECCION
    public function insertar($datos){

        $nombreDireccion = $this->db->table('wk_direccion');
        $nombreDireccion->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR DIRECCION
    public function eliminar($data){
        $nombres = $this->db->table('wk_direccion');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en DIRECCION
    public function actualizar($data, $direccionId){
        $nombres = $this->db->table('wk_direccion');
        $nombres->set($data);
        $nombres->where('direccionId', $direccionId);
        return $nombres->update();
    }

}