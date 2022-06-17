<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class PersonaModel extends Model{
   
    //LISTADO DE PERSONAS
    public function listarPersona()
    {
        $persona = $this->db->query("SELECT p.personaId as 'id', p.dui as 'dui', p.nombres as 'nombre',  
                                    concat_ws(
                                        ' ',
                                        p.primerApellido,
                                        p.segundoApellido
                                    ) apellidos, p.fechaNacimiento, if(p.genero = 'F', 'Femenino', 'Masculino') as 'genero', 
                                        c.cargo as 'cargo', d.departamento as 'departamento', p.cargoId as 'cargoId', p.departamentoId as 'departamentoId'
                                        FROM wk_persona p
                                        INNER JOIN wk_cargo c ON p.cargoId = c.cargoId
                                        INNER JOIN wk_departamento d ON p.departamentoId = d.departamentoId
                                        ORDER BY p.personaId");
        return $persona->getResult();
    }

    //LISTADO DE MUNICIPIO
    public function listarCargo()
    {
        $cargo =  $this->db->query('SELECT*FROM  wk_cargo');
        return $cargo->getResult();
    }

    //LISTADO DE MUNICIPIO
    public function listarDepartamento()
    {
        $departamento =  $this->db->query('SELECT*FROM  wk_departamento');
        return $departamento->getResult();
    }

    //MODELO PARA AGREGAR DIRECCION
    public function insertar($datos){

        $nombrePersona = $this->db->table('wk_persona');
        $nombrePersona->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR DIRECCION
    public function eliminar($data){
        $nombres = $this->db->table('wk_persona');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en DIRECCION
    public function actualizar($data, $personaId){
        $nombres = $this->db->table('wk_persona');
        $nombres->set($data);
        $nombres->where('personaId', $personaId);
        return $nombres->update();
    }

}