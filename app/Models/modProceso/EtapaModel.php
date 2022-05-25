<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class EtapaModel extends Model{

    protected $table = 'wk_etapa';
    protected $primaryKey = 'etapaId';
    protected $allowedFields = ['etapaId', 'nombreEtapa', 'orden', 'procesoId', 'personaId'];

    //MODELO PARA LISTAR ETAPA
    public function listarEtapa($procesoId)
    {
        $etapa = $this->db->query("SELECT e.etapaId as 'id', e.nombreEtapa as 'nombre', e.orden as 'orden', p.nombreProceso as 'proceso', p.procesoId as 'procesoId'
                                        FROM wk_etapa e
                                        INNER JOIN wk_proceso p ON p.procesoId = e.procesoId
                                        WHERE p.procesoId = $procesoId
                                        ORDER BY e.orden");
        return $etapa->getResult();
    }

    //etapaC
    public function listarEtapaC($procesoId)
    {
        $etapa = $this->db->query("SELECT e.etapaId as 'id', e.nombreEtapa as 'nombre', e.orden as 'orden', p.nombreProceso as 'proceso', p.procesoId as 'procesoId'
                                        FROM wk_etapa e
                                        INNER JOIN wk_proceso p ON p.procesoId = e.procesoId
                                        WHERE p.procesoId = $procesoId
                                        ORDER BY e.orden");
        return $etapa->getResult();
    }
    
    //MODELO PARA LISTAR PROCESO
    public function listarProceso()
    {
        return $this->asObject()
        ->select("*")
        ->from('wk_proceso')
        ->orderBy('wk_proceso.procesoId')
        ->findAll();
    }

    //MODELO PARA AGREGAR ETAPA
    public function insertar($datos){

        $nombre = $this->db->table('wk_etapa');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR ETAPA
    public function eliminar($etapaId){
        $nombres = $this->db->table('wk_etapa');
        $nombres->where($etapaId);
        
        return $nombres->delete();
    }

    //Edita el registro en ETAPA
    public function actualizar($data, $etapaId){
        $nombres = $this->db->table('wk_etapa');
        $nombres->set($data);
        $nombres->where('etapaId', $etapaId);
        return $nombres->update();
    }
}