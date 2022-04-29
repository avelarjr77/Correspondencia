<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class ProcesoModel extends Model{

    protected $table = 'wk_proceso';
    protected $primaryKey = 'procesoId';
    protected $allowedFields = ['procesoId', 'nombreProceso', 'tipoProcesoId'];

    //MODELO PARA LISTAR PROCESO
    public function listarProceso()
    {
        return $this->asObject()
        ->select("wk_proceso.procesoId as 'id', wk_proceso.nombreProceso as 'nombre', tp.tipoProceso as 'tipoProceso'")
        ->join('wk_tipo_proceso tp','tp.tipoProcesoId = wk_proceso.tipoProcesoId')
        ->orderBy('wk_proceso.procesoId')
        ->findAll();
    }
    
    //MODELO PARA LISTAR TIPO PROCESO
    public function listarTipoProceso()
    {
        return $this->asObject()
        ->select("*")
        ->from('wk_tipo_proceso')
        ->orderBy('wk_tipo_proceso.tipoProcesoId')
        ->findAll();
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