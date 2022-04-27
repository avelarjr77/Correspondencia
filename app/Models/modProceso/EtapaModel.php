<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class EtapaModel extends Model{

    //MODELO PARA LISTAR PROCESO
    public function listarEtapa()
    {
        $etapa =  $this->db->query("SELECT e.etapaId as 'id', e.nombreEtapa as 'nombre',e.orden as 'orden', p.nombreProceso as 'proceso', e.procesoId 
                                      FROM  wk_etapa e 
                                      INNER JOIN wk_proceso p ON e.procesoId = p.procesoId
                                      ORDER BY e.etapaId");
        return $etapa->getResult();
    }
    
    //MODELO PARA LISTAR TIPO PROCESO
    public function listarProceso()
    {
        $proceso =  $this->db->query('SELECT*FROM  wk_proceso');
        return $proceso->getResult();
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