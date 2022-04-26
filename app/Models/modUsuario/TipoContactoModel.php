<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class TipoContactoModel extends Model{

    //MODELO PARA LISTAR ROLES
    public function listarTipoContactos()
    {
        $tipoContacto =  $this->db->query('SELECT*FROM  wk_tipo_contacto');
        return $tipoContacto->getResult();
    }


    //MODELO PARA AGREGAR ROL
    public function insertar($datos){

        $tipoContacto = $this->db->table('wk_tipo_contacto');
        $tipoContacto->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR
    public function eliminar($data){
        $nombres = $this->db->table('wk_tipo_contacto');
        $nombres->where($data);
        return $nombres->delete();
    }

    //Edita el registro en rol
    public function actualizar($data, $tipoContactoId){
        $nombres = $this->db->table('wk_tipo_contacto');
        $nombres->set($data);
        $nombres->where('tipoContactoId', $tipoContactoId);
        return $nombres->update();
    }


}