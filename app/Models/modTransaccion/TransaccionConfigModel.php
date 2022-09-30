<?php

namespace App\Models\modTransaccion;

use CodeIgniter\Model;

class TransaccionConfigModel extends Model
{
    protected $table = 'wk_transaccion';
    protected $primaryKey = 'transaccionId';
    protected $allowedFields = ['transaccionId', 'procesoId', 'personaId', 'institucionId', 'estadoTransaccion', 'fechaInicio', 'fechaFin', 'horaInicio', 'horaFin', 'observaciones'];

    public function transaccionData()
    {
        $tr = $this->db->query("SELECT t.transaccionId as 'id', p.nombreProceso as 'proceso', pe.nombres as 'persona', t.procesoId,
                                i.nombreInstitucion as 'institucion', 
                                (CASE
                                    WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    ELSE 'Inactivo'
                                END) as 'estado', t.observaciones
                                FROM wk_transaccion t
                                INNER JOIN wk_proceso p ON p.procesoId = t.procesoId
                                INNER JOIN wk_institucion i ON i.institucionId = t.institucionId
                                INNER JOIN wk_persona pe ON pe.personaId = t.personaId
                                WHERE t.estadoTransaccion != 'A' AND t.estadoTransaccion != 'F'
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function transaccionDataFin()
    {
        $tr = $this->db->query("SELECT t.transaccionId as 'id', p.nombreProceso as 'proceso', pe.nombres as 'persona', t.procesoId,
                                i.nombreInstitucion as 'institucion', 
                                (CASE
                                    WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    ELSE 'Inactivo'
                                END) as 'estado', t.observaciones
                                FROM wk_transaccion t
                                INNER JOIN wk_proceso p ON p.procesoId = t.procesoId
                                INNER JOIN wk_institucion i ON i.institucionId = t.institucionId
                                INNER JOIN wk_persona pe ON pe.personaId = t.personaId
                                WHERE t.estadoTransaccion = 'F'
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function transaccionDataO($transaccionId)
    {
        $tr = $this->db->query("SELECT t.transaccionId as 'id', p.nombreProceso as 'proceso', pe.nombres as 'persona', t.procesoId,
                                i.nombreInstitucion as 'institucion', 
                                (CASE
                                    WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    ELSE 'Inactivo'
                                END) as 'estado', t.observaciones
                                FROM wk_transaccion t
                                INNER JOIN wk_proceso p ON p.procesoId = t.procesoId
                                INNER JOIN wk_institucion i ON i.institucionId = t.institucionId
                                INNER JOIN wk_persona pe ON pe.personaId = t.personaId
                                WHERE t.transaccionId= $transaccionId
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function estadoData()
    {
        $tr = $this->db->query("SELECT 
                                (CASE
                                    WHEN t.estadoTransaccion = 'A' THEN 'Activo'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    ELSE 'Inactivo'
                                END) as 'estado'
                                FROM wk_transaccion t
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }
   
    public function listarProceso()
    {
        $proceso =  $this->db->query("SELECT*
                                    FROM  wk_proceso p");
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

    /* public function listarEtapa($procesoId)
    {
        $etapa = $this->db->query("SELECT e.etapaId as 'id'
                                        FROM wk_etapa e
                                        INNER JOIN wk_proceso p ON p.procesoId = e.procesoId
                                        WHERE p.procesoId = $procesoId
                                        ORDER BY e.orden
                                        LIMIT 1");
        return $etapa->getResult();
    } */

    public function obtenerTDID()
    {
        $etapaId = $this->db->query("SELECT MAX(transaccionDetalleId) AS 'id'
                                    FROM wk_transaccion_detalle td");
        return $etapaId->getResult();
    }

    public function obtenerTAID()
    {
        $tAId = $this->db->query("SELECT MAX(transaccionActividadId) AS 'id'
                                    FROM wk_transaccion_actividades ta");
        return $tAId->getResult();
    }

    public function listarEtapa($procesoId)
    {
        $etapa = $this->db->query("SELECT vp.etapaId
                                    FROM vista_con_procesos vp
                                    WHERE vp.procesoId = $procesoId
                                    GROUP BY vp.etapaId
                                    ORDER BY vp.ordenEtapa
                                    LIMIT 1");
        return $etapa->getResult();
    }

    public function listarTransaccionDet($transaccionId)
    {
        $etapa = $this->db->query("SELECT td.transaccionDetalleId as 'id', e.nombreEtapa as 'etapa', td.etapaId, 
                                        td.fechaInicio, td.fechaFin, td.horaInicio, td.horaFin, 
                                        (CASE
                                            WHEN td.estado = 'P' THEN 'En Progreso'
                                            WHEN td.estado = 'F' THEN 'Finalizado'
                                            ELSE 'Inactivo'
                                        END) as 'estado'
                                        FROM wk_transaccion_detalle td
                                        INNER JOIN wk_etapa e ON e.etapaId = td.etapaId
                                        INNER JOIN wk_transaccion t ON t.transaccionId = td.transaccionId
                                        WHERE t.transaccionId = $transaccionId
                                        ORDER BY e.orden");
        return $etapa->getResult();
    }

    /* public function listarActividad($etapaId)
    {
        $actividad = $this->db->query("SELECT a.actividadId as 'id'
                                        FROM wk_actividad a
                                        INNER JOIN wk_etapa e ON e.etapaId = a.etapaId
                                        WHERE e.etapaId = $etapaId
                                        ORDER BY a.ordenActividad");
        return $actividad->getResult();
    } */

    public function listarActividad($etapaId)
    {
        $actividad = $this->db->query("SELECT v.actividadId
                                        FROM vista_con_procesos v
                                        WHERE v.etapaId = $etapaId
                                        ORDER BY v.ordenActividad
                                        LIMIT 1");
        return $actividad->getResult();
    }

    public function listarTransaccionAct($transaccionDetalleId)
    {
        $actividadT = $this->db->query("SELECT ta.transaccionActividadId as 'id', a.nombreActividad as 'actividad', ta.actividadId, 
                                        ta.fechaCreacion, ta.horaCreacion, ta.fechaInicio, ta.fechaFin, ta.horaInicio, ta.horaFin, p.nombres as 'persona', a.personaId,
                                        (CASE
                                            WHEN ta.estado = 'P' THEN 'En Progreso'
                                            WHEN ta.estado = 'F' THEN 'Finalizado'
                                            ELSE 'Inactivo'
                                        END) as 'estado'
                                        FROM wk_transaccion_actividades ta
                                        INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                        INNER JOIN wk_persona p ON p.personaId = a.personaId
                                        INNER JOIN wk_transaccion_detalle t ON t.transaccionDetalleId = ta.transaccionDetalleId
                                        WHERE t.transaccionDetalleId = $transaccionDetalleId
                                        ORDER BY a.ordenActividad");
        return $actividadT->getResult();
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

}