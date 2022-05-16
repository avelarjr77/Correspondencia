<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class ActividadModel extends Model{

    protected $table = 'wk_actividad';
    protected $primaryKey = 'actividadId';
    protected $allowedFields = ['actividadId', 'nombreActividad', 'descripcion', 'etapaId'];

    //MODELO PARA LISTAR PROCESO
    public function listarActividad($etapaId)
    {
        return $this->asObject()
        ->select("wk_actividad.actividadId as 'id', wk_actividad.nombreActividad as 'nombre', wk_actividad.descripcion as 'descripcion', e.nombreEtapa as 'etapa', wk_actividad.etapaId, pe.nombres as 'persona', wk_actividad.personaId")
        ->join('wk_etapa e','e.etapaId = wk_actividad.etapaId')
        ->join('wk_persona pe','pe.personaId = wk_actividad.personaId')
        ->where('e.etapaId',$etapaId)
        ->orderBy('wk_actividad.actividadId')
        ->findAll();
    }
    
    //MODELO PARA LISTAR TIPO ETAPA
    public function listarEtapa()
    {
        return $this->asObject()
        ->select("*")
        ->from('wk_etapa')
        ->orderBy('wk_etapa.etapaId')
        ->findAll();
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