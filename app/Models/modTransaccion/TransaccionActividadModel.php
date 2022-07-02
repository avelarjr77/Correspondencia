<?php

namespace App\Models\modTransaccion;

use CodeIgniter\Model;

class TransaccionActividadModel extends Model
{
    protected $table = 'wk_transaccion_actividades';
    protected $primaryKey = 'transaccionActividadId';
    protected $allowedFields = ['transaccionActividadId', 'transaccionDetalleId', 'actividadId', 'fechaInicio', 'fechaFin', 'horaInicio', 'horaFin', 'estado', 'observaciones'];

    public function listarTransaccionAct($personaId)
    {
        $actividadT = $this->db->query("SELECT ta.transaccionActividadId as 'id', a.nombreActividad as 'actividad', ta.actividadId, 
                                        ta.fechaInicio, ta.fechaFin, ta.horaInicio, ta.horaFin, p.nombres as 'persona', a.personaId,
                                        (CASE
                                            WHEN ta.estado = 'A' THEN 'Activo'
                                            WHEN ta.estado = 'F' THEN 'Finalizado'
                                            ELSE 'Inactivo'
                                        END) as 'estado'
                                        FROM wk_transaccion_actividades ta
                                        INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                        INNER JOIN wk_persona p ON p.personaId = a.personaId
                                        INNER JOIN wk_transaccion_detalle t ON t.transaccionDetalleId = ta.transaccionDetalleId
                                        WHERE p.personaId = $personaId
                                        ORDER BY a.ordenActividad");
        return $actividadT->getResult();
    }

    public function obtenerActividadOrden($etapaId, $ordenActividad)
    {
        $actividadTO = $this->db->query("SELECT vp.actividadId
                                        FROM vista_con_procesos vp
                                        WHERE vp.etapaId = $etapaId AND vp.ordenActividad > $ordenActividad
                                        ORDER BY vp.ordenActividad
                                        LIMIT 1");
        return $actividadTO->getResult();
    }
    
    
    //MODELO PARA AGREGAR TRANSACCION
    public function insertar($datos){

        $nombre = $this->db->table('wk_transaccion');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    public function insertarT($data){

        $nombre = $this->db->table('wk_transaccion_detalle');
        $nombre->insert($data);

        return $this->db->insertID();
    }

    public function insertarAct($datos){

        $nombre = $this->db->table('wk_transaccion_actividades');
        $nombre->insert($datos);

        return $this->db->insertID();
    }

    //MODELO PARA ELIMINAR TRANSACCION
    public function eliminar($data){
        $nombres = $this->db->table('wk_transaccion');
        $nombres->where($data);
        
        return $nombres->delete();
    }

    public function eliminarP($data){
        $nombre = $this->db->table('wk_transaccion');
        $nombre->where($data);
        
        return $nombre->delete();
    }

    //Edita el registro en TRANSACCION
    public function actualizar($estado, $transaccionId){
        $nombres = $this->db->table('wk_transaccion');
        $nombres->set($estado);
        $nombres->where('transaccionId', $transaccionId);
        return $nombres->update();
    }

    //actualizar TDetalle
    public function actualizarT($datos, $id){
        $nombre = $this->db->table('wk_transaccion_detalle');
        $nombre->set($datos);
        $nombre->where('transaccionDetalleId', $id);
        return $nombre->update();
    }

    //actualizar TActividad
    public function actualizarA($datos, $id){
        $nombre = $this->db->table('wk_transaccion_actividades');
        $nombre->set($datos);
        $nombre->where('transaccionActividadId', $id);
        return $nombre->update();
    }

    //actualizar TObservaciones
    public function actualizarO($datos, $id){
        $nombre = $this->db->table('wk_transaccion_actividades');
        $nombre->set($datos);
        $nombre->where('transaccionActividadId', $id);
        return $nombre->update();
    }

}