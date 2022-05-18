<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table 			= 'wk_usuario';
	protected $primaryKey 		= 'usuarioId';
	protected $allowedFields 	= ['usuarioId', 'personaId', 'usuario', 'clave', 'estado', 'rolId'];

   
    //LISTADO DE USUARIOS
    public function listarUsuario()
    {
        $persona = $this->db->query("SELECT u.usuarioId as 'id', p.nombres as 'nombre',  
                                        u.usuario,u.clave, if(u.estado = 'A', 'Activo', 'Inactivo') as 'estado', r.nombreRol as 'rol'
                                        FROM wk_usuario u
                                        INNER JOIN wk_persona p ON u.personaId = p.personaId
                                        INNER JOIN wk_rol r ON u.rolId = r.rolId
                                        ORDER BY u.usuarioId");
        return $persona->getResult();
    }

    //LISTADO DE PERSONA
    public function listarPersona()
    {
        $persona =  $this->db->query('SELECT*FROM  wk_persona');
        return $persona->getResult();
    }

    //LISTADO DE ROL
    public function listarRol()
    {
        $rol =  $this->db->query('SELECT*FROM  wk_rol');
        return $rol->getResult();
    }

    //MODELO PARA AGREGAR USUARIO
    public function insertar($datos){

        $nombre = $this->db->table('wk_usuario');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR USUARIO
    public function eliminar($data){
        $nombres = $this->db->table('wk_usuario');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en USUARIO
    public function actualizar($data, $usuarioId){
        $nombres = $this->db->table('wk_usuario');
        $nombres->set($data);
        $nombres->where('usuarioId', $usuarioId);
        return $nombres->update();
    }

}