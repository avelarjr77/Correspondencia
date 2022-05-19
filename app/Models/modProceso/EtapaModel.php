<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class EtapaModel extends Model{

    protected $table = 'wk_etapa';
    protected $primaryKey = 'etapaId';
    protected $allowedFields = ['etapaId', 'nombreEtapa', 'orden', 'procesoId', 'personaId'];

    //MODELO PARA LISTAR PROCESO
    public function listarEtapa($procesoId)
    {
        $etapa = $this->db->query("SELECT e.etapaId as 'id', e.nombreEtapa as 'nombre', e.orden as 'orden', p.nombreProceso as 'proceso', p.procesoId as 'procesoId'
                                        FROM wk_etapa e
                                        INNER JOIN wk_proceso p ON p.procesoId = e.procesoId
                                        WHERE p.procesoId = $procesoId
                                        ORDER BY e.orden");
        return $etapa->getResult();
    }
    
    //MODELO PARA LISTAR TIPO PROCESO
    public function listarProceso()
    {
        return $this->asObject()
        ->select("*")
        ->from('wk_proceso')
        ->orderBy('wk_proceso.procesoId')
        ->findAll();
    }

    //MODELO PARA AGREGAR PROCESO
    public function insertar($datos){

        $nombre = $this->db->table('wk_etapa');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR PROCESO
    public function eliminar($data){
        $nombres = $this->db->table('wk_etapa');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en PROCESO
    public function actualizar($data, $etapaId){
        $nombres = $this->db->table('wk_etapa');
        $nombres->set($data);
        $nombres->where('etapaId', $etapaId);
        return $nombres->update();
    }
}