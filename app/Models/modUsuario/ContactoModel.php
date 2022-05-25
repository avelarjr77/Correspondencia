<?php

namespace App\Models\modUsuario;

use CodeIgniter\Model;

class ContactoModel extends Model
{
    protected $table 			= 'wk_contacto';
	protected $primaryKey 		= 'contactoId';
	protected $allowedFields 	= ['contactoId', 'personaId', 'tipoContacto', 'uuid', 'contacto', 'estado'];

    //MODELO PARA LISTAR CONTACTO
    public function listarContacto()
    {
        $contacto = $this->db->query("SELECT  CONCAT_WS(' ', p.nombres, p.primerApellido) as 'nombre', tc.tipoContacto as 'tipoContacto',c.contactoId as 'contactoId', c.contacto, c.estado
        FROM wk_persona p
        INNER JOIN wk_contacto c ON p.personaId = c.personaId
        INNER JOIN wk_tipo_contacto tc ON c.tipoContactoId = tc.tipoContactoId
        INNER JOIN wk_usuario rr ON p.personaId = rr.personaId
        group by contacto");
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
    //MODELO PARA AGREGAR Contacto
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
