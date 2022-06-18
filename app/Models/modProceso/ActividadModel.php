<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class ActividadModel extends Model{

    protected $table = 'wk_actividad';
    protected $primaryKey = 'actividadId';
    protected $allowedFields = ['actividadId', 'nombreActividad', 'descripcion', 'ordenActividad', 'etapaId'];

    //MODELO PARA LISTAR PROCESO
    public function listarActividad($etapaId)
    {
        $actividad = $this->db->query("SELECT a.actividadId as 'id', a.nombreActividad as 'nombre', a.descripcion as 'descripcion', a.ordenActividad as 'ordenA', e.nombreEtapa as 'etapa', a.etapaId, pe.nombres as 'persona', a.personaId
                                        FROM wk_actividad a
                                        INNER JOIN wk_etapa e ON e.etapaId = a.etapaId
                                        INNER JOIN wk_persona pe ON pe.personaId = a.personaId
                                        WHERE e.etapaId = $etapaId
                                        ORDER BY a.ordenActividad");
        return $actividad->getResult();
    }
    
    //MODELO PARA LISTAR PERSONA
    public function listarPersona()
    {
        $cargo =  $this->db->query('SELECT*FROM  wk_persona');
        return $cargo->getResult();
    }

    public function etapaL($etapaId)
    {
        $etapa = $this->db->query("SELECT  e.nombreEtapa as 'etapa'
                                    FROM wk_etapa e
                                    WHERE e.etapaId = $etapaId");
        return $etapa->getResult();
    }

    //MODELO PARA AGREGAR PROCESO
    public function insertar($datos){

        $nombre = $this->db->table('wk_actividad');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR PROCESO
    public function eliminar($data){
        $nombres = $this->db->table('wk_actividad');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en PROCESO
    public function actualizar($data, $actividadId){
        $nombres = $this->db->table('wk_actividad');
        $nombres->set($data);
        $nombres->where('actividadId', $actividadId);
        return $nombres->update();
    }
}