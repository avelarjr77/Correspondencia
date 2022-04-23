<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class ProcesoModel extends Model{

    //MODELO PARA LISTAR PROCESO
    public function listarProceso()
    {
        $proceso =  $this->db->query("SELECT p.procesoId as 'id', p.nombreProceso as 'nombre', tp.tipoProceso as 'tipoProceso'
                                      FROM  wk_proceso P 
                                      INNER JOIN wk_tipo_proceso tp ON p.tipoProcesoId = tp.tipoProcesoId
                                      ORDER BY p.procesoId");
        return $proceso->getResult();
    }
    
    //MODELO PARA LISTAR TIPO PROCESO
    public function listarTipoProceso()
    {
        $tipoProceso =  $this->db->query('SELECT*FROM  wk_tipo_proceso');
        return $tipoProceso->getResult();
    }

    //MODELO PARA AGREGAR PROCESO
    public function insertar($datos){

        $nombreProceso = $this->db->table('wk_proceso');
        $nombreProceso->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR PROCESO
    public function eliminar($data){
        $nombres = $this->db->table('wk_proceso');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en PROCESO
    public function actualizar($data, $procesoId){
        $nombres = $this->db->table('wk_proceso');
        $nombres->set($data);
        $nombres->where('procesoId', $procesoId);
        return $nombres->update();
    }
}