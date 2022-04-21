<?php

namespace App\Models\modUsuario;

use CodeIgniter\Model;

class ContactoModel extends Model
{

    //MODELO PARA LISTAR ROLES
    public function listarContacto()
    {
        $contacto = $this->db->query("SELECT d.contactoId as 'contactoId', CONCAT_WS(' ', p.nombres, p.primerApellido) as 'nombre', tc.tipoContacto as 'tipoContacto', contacto, estado
                                                FROM wk_contacto d
                                                INNER JOIN wk_persona p ON d.personaId = p.personaId
                                                INNER JOIN wk_tipo_contacto tc ON d.tipoContactoId = tc.tipoContactoId
                                                ORDER BY d.contactoId");
        return $contacto->getResult();
    }

    
    public function listarTipoContactos()
    {
        $tipoContacto =  $this->db->query('SELECT*FROM  wk_tipo_contacto');
        return $tipoContacto->getResult();
    }

    //LISTADO DE PERSONAS
    public function listarPersona()
    {
        $persona =  $this->db->query('SELECT*FROM  wk_persona');
        return $persona->getResult();
    }
    //MODELO PARA AGREGAR ROL
    public function insertarContacto($datos)
    {

        $tipoContacto = $this->db->table('wk_contacto');
        $tipoContacto->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA AGREGAR ROL
    public function insertar($datos)
    {

        $tipoContacto = $this->db->table('wk_tipo_contacto');
        $tipoContacto->insert($datos);

        return $this->db->insertID();
    }

     //MODELO PARA ELIMINAR CONTACTO
     public function eliminarContacto($data)
     {
         $nombres = $this->db->table('wk_contacto');
         $nombres->where($data);
 
         return $nombres->delete();
     }
     //MODELO PARA ELIMINAR TIPOCONTACTO
    public function eliminar($data)
    {
        $nombres = $this->db->table('wk_tipo_contacto');
        $nombres->where($data);

        return $nombres->delete();
    }

    //Edita el registro en tipo de contacto
    public function actualizar($data, $tipoContactoId)
    {
        $nombres = $this->db->table('wk_tipo_contacto');
        $nombres->set($data);
        $nombres->where('tipoContactoId', $tipoContactoId);
        return $nombres->update();
    }
    //Edita el registro en CONTACTO
    public function actualizarContacto($data, $contactoId)
    {
        $contacto = $this->db->table('wk_contacto');
        $contacto->set($data);
        $contacto->where('contactoId', $contactoId);
        return $contacto->update();
    }
}
