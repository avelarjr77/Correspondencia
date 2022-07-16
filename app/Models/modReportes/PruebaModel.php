<?php

namespace App\Models\modReportes;

use CodeIgniter\Model;

class PruebaModel extends Model
{
    protected $table = 'wk_transaccion_actividades';
    protected $primaryKey = 'transaccionActividadId';
    protected $allowedFields = ['transaccionActividadId', 'transaccionDetalleId', 'actividadId', 'fechaInicio', 'fechaFin', 'horaInicio', 'horaFin', 'estado', 'observaciones'];

    public function reporte()
    {
        $tr = $this->db->query("SELECT t.transaccionId as 'id', p.nombreProceso as 'proceso', 
                                concat_ws(
                                    ' ',
                                    pe.nombres,
                                    pe.primerApellido
                                ) as 'persona',
                                i.nombreInstitucion as 'institucion', 
                                (CASE
                                    WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    ELSE 'Inactivo'
                                END) as 'estado'
                                FROM wk_transaccion t
                                INNER JOIN wk_proceso p ON p.procesoId = t.procesoId
                                INNER JOIN wk_institucion i ON i.institucionId = t.institucionId
                                INNER JOIN wk_persona pe ON pe.personaId = t.personaId
                                WHERE MONTH (t.fechaInicio) = MONTH (NOW())
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function reporte2()
    {
        $tr = $this->db->query("SELECT a.nombreActividad as 'actividad', 
                                concat_ws(
                                    ' ',
                                    p.nombres,
                                    p.primerApellido
                                ) as 'persona', 
                                ROUND(AVG(TIMESTAMPDIFF(DAY, ta.fechaInicio, ta.fechaFin))) as 'promedio'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                WHERE ta.estado = 'F' 
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

}