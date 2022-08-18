<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class DocumentoModel extends Model{

    protected $table = 'wk_documento';
    protected $primaryKey = 'documentoId';
    protected $allowedFields = ['documentoId', 'nombreDocumento', 'tipoDocumentoId', 'tipoEnvioId', 'transaccionActividadId'];

   
    //LISTADO DE DOCUMENTO
    public function listarDocumento()
    {
        $documento = $this->db->query("SELECT d.documentoId as 'documentoId', d.nombreDocumento as 'nombreDocumento', td.tipoDocumento as 'tipoDocumentoId', 
                                       te.tipoEnvio as 'tipoEnvioId', d.transaccionActividadId as 'transaccionActividadId'
                                        FROM wk_documento d
                                        INNER JOIN wk_tipo_documento td ON d.tipoDocumentoId = td.tipoDocumentoId
                                        INNER JOIN wk_tipo_envio te ON d.tipoEnvioId = te.tipoEnvioId
                                        ORDER BY d.documentoId");
        return $documento->getResult();
    }

    //LISTADO DE TIPO DE DOCUMENTO
    public function listarTipoDocumento()
    {
        $tipoDocumento =  $this->db->query('SELECT*FROM  wk_tipo_documento');
        return $tipoDocumento->getResult();
    }

    //LISTADO DE TIPO DE ENVIO
    public function listarTipoEnvio()
    {
        $tipoEnvio =  $this->db->query('SELECT*FROM  wk_tipo_envio');
        return $tipoEnvio->getResult();
    }

    //MODELO PARA AGREGAR DOCUMENTO
    public function insertar($datos){

        $nombreDocumento = $this->db->table('wk_documento');
        $nombreDocumento->insert($datos);

        return $this->db->insertID();
    }

    //Edita el registro en documento
    public function actualizar($data, $documentoId){
        $actualizarDoc = $this->db->table('wk_documento');
        $actualizarDoc->set($data);
        $actualizarDoc->where('documentoId', $documentoId);
        return $actualizarDoc->update();
    }

    /* public function actualizarDoc($data, $documentoId){
        $actualizarDoc = $this->db->table('wk_documento');
        $actualizarDoc->set($data);
        $actualizarDoc->where('documentoId', $documentoId);
        return $actualizarDoc->update();
    } */

    //MODELO PARA ELIMINAR DOCUMENTO
    public function eliminar($data){
        $nombreDocumento = $this->db->table('wk_documento');
        $nombreDocumento->where($data);
        
        return $nombreDocumento->delete();
    }
    public function eliminarImg($img){
        $imagen = $this->db->query("SELECT nombreDocumento FROM wk_documento");
        $imagen->where($img);
        
        return $imagen->getResult();
    }

}