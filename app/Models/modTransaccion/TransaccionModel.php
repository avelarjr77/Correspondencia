<?php

namespace App\Models\modTransaccion;

use CodeIgniter\Model;

class TransaccionModel extends Model
{
    protected $table = 'wk_transaccion';
    protected $primaryKey = 'transaccionId';
    protected $allowedFields = ['transaccionId', 'procesoId', 'personaId', 'institucionId', 'estadoTransaccion', 'fechaInicio', 'fechaFin', 'horaInicio', 'horaFin', 'observaciones'];

    public function getTransaccion(){
        return $this->asObject()
        ->select("wk_transaccion.transaccionId as 'id', p.nombreProceso as 'proceso', pe.nombres as 'persona', 
        i.nombreInstitucion as 'institucion', wk_transaccion.estadoTransaccion as 'estadoT', wk_transaccion.fechaInicio, wk_transaccion.fechaFin, 
        wk_transaccion.horaInicio, wk_transaccion.horaFin, wk_transaccion.observaciones")
        ->join('wk_proceso p','p.procesoId = wk_transaccion.procesoId')
        ->join('wk_persona pe','pe.personaId = wk_transaccion.personaId')
        ->join('wk_institucion i','i.institucionId = wk_transaccion.institucionId')
        ->orderBy('wk_transaccion.transaccionId')
        ->findAll();
    }


    public function listarProceso()
    {
        $proceso =  $this->db->query('SELECT*FROM  wk_proceso');
        return $proceso->getResult();
    }

    public function listarPersona()
    {
        $persona =  $this->db->query('SELECT*FROM  wk_persona');
        return $persona->getResult();
    }

    public function listarInstitucion()
    {
        $institucion =  $this->db->query('SELECT*FROM  wk_institucion');
        return $institucion->getResult();
    }

    //MODELO PARA AGREGAR TRANSACCION
    public function insertar($datos){

        $nombre = $this->db->table('wk_transaccion');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR TRANSACCION
    public function eliminar($data){
        $nombres = $this->db->table('wk_transaccion');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    //Edita el registro en TRANSACCION
    public function actualizar($data, $transaccionId){
        $nombres = $this->db->table('wk_transaccion');
        $nombres->set($data);
        $nombres->where('transaccionId', $transaccionId);
        return $nombres->update();
    }

}