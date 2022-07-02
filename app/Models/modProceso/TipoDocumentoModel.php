<?php 
namespace App\Models\modProceso;

use CodeIgniter\Model;

class TipoDocumentoModel extends Model{

    protected $table = 'wk_tipo_documento';
    protected $primaryKey = 'tipoDocumentoId';
    protected $allowedFields = ['tipoDocumentoId', 'tipoDocumento'];

    //MODELO PARA LISTAR TIPO DOCUMENTO
    public function listarTipoDocumento()
    {
        return $this->asObject()
        ->select("*")
        ->orderBy('wk_tipo_documento.tipoDocumentoId')
        ->findAll();
    }

    //MODELO PARA AGREGAR TIPO DOCUMENTO
    public function insertar($datos){

        $nombre = $this->db->table('wk_tipo_documento');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR TIPO DOCUMENTO
    public function eliminar($data){
        $nombres = $this->db->table('wk_tipo_documento');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en TIPO DOCUMENTO
    public function actualizar($data, $tipoDocumentoId){
        $nombres = $this->db->table('wk_tipo_documento');
        $nombres->set($data);
        $nombres->where('tipoDocumentoId', $tipoDocumentoId);
        return $nombres->update();
    }
}