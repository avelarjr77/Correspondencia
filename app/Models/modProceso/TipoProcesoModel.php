<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class TipoProcesoModel extends Model{

    protected $table = 'wk_tipo_proceso';
    protected $primaryKey = 'tipoProcesoId';
    protected $allowedFields = ['tipoProcesoId', 'tipoProceso'];

    //MODELO PARA LISTAR TIPO PROCESO
    public function listarTipoProceso()
    {
        return $this->asObject()
        ->select("*")
        ->orderBy('wk_tipo_proceso.tipoProcesoId')
        ->findAll();
    }

    //MODELO PARA AGREGAR TIPO PROCESO
    public function insertar($datos){

        $nombre = $this->db->table('wk_tipo_proceso');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR TIPO PROCESO
    public function eliminar($data){
        $nombres = $this->db->table('wk_tipo_proceso');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en TIPO PROCESO
    public function actualizar($data, $tipoProcesoId){
        $nombres = $this->db->table('wk_tipo_proceso');
        $nombres->set($data);
        $nombres->where('tipoProcesoId', $tipoProcesoId);
        return $nombres->update();
    }


}