<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class ActividadModel extends Model{

    //MODELO PARA LISTAR PROCESO
    public function listarActividad()
    {
        $actividad =  $this->db->query("SELECT a.actividadId as 'id', a.nombreActividad as 'nombre',a.descripcion as 'descripcion', p.nombreEtapa as 'etapa'
                                      FROM  wk_actividad a 
                                      INNER JOIN wk_etapa p ON a.etapaId = p.etapaId
                                      ORDER BY a.actividadId");
        return $actividad->getResult();
    }
    
    //MODELO PARA LISTAR TIPO ETAPA
    public function listarEtapa()
    {
        $etapa =  $this->db->query('SELECT*FROM  wk_etapa');
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