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
                                END) as 'estado',
                                (CASE
                                    WHEN MONTH(t.fechaInicio) = 1 THEN 'Enero'
                                    WHEN MONTH(t.fechaInicio) = 2 THEN 'Febrero'
                                    WHEN MONTH(t.fechaInicio) = 3 THEN 'Marzo'
                                    WHEN MONTH(t.fechaInicio) = 4 THEN 'Abril'
                                    WHEN MONTH(t.fechaInicio) = 5 THEN 'Mayo'
                                    WHEN MONTH(t.fechaInicio) = 6 THEN 'Junio'
                                    WHEN MONTH(t.fechaInicio) = 7 THEN 'Julio'
                                    WHEN MONTH(t.fechaInicio) = 8 THEN 'Agosto'
                                    WHEN MONTH(t.fechaInicio) = 9 THEN 'Septiembre'
                                    WHEN MONTH(t.fechaInicio) = 10 THEN 'Octubre'
                                    WHEN MONTH(t.fechaInicio) = 11 THEN 'Noviembre'
                                    ELSE 'Diciembre'
                                END) as 'mes'
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

    public function reporte3()
    {
        $tr = $this->db->query("SELECT  p.nombreProceso as 'proceso', e.nombreEtapa as 'etapa', a.nombreActividad as 'actividad',
                                (CASE
                                WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                WHEN t.estadoTransaccion = 'I' THEN 'Inactivo'
                                ELSE '-'
                                END) as 'estado', 
                                (CASE
                                    WHEN MONTH(t.fechaInicio) = 1 THEN 'Enero'
                                    WHEN MONTH(t.fechaInicio) = 2 THEN 'Febrero'
                                    WHEN MONTH(t.fechaInicio) = 3 THEN 'Marzo'
                                    WHEN MONTH(t.fechaInicio) = 4 THEN 'Abril'
                                    WHEN MONTH(t.fechaInicio) = 5 THEN 'Mayo'
                                    WHEN MONTH(t.fechaInicio) = 6 THEN 'Junio'
                                    WHEN MONTH(t.fechaInicio) = 7 THEN 'Julio'
                                    WHEN MONTH(t.fechaInicio) = 8 THEN 'Agosto'
                                    WHEN MONTH(t.fechaInicio) = 9 THEN 'Septiembre'
                                    WHEN MONTH(t.fechaInicio) = 10 THEN 'Octubre'
                                    WHEN MONTH(t.fechaInicio) = 11 THEN 'Noviembre'
                                    ELSE 'Diciembre'
                                END) as 'mes'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_transaccion_detalle td ON ta.transaccionDetalleId = td.transaccionDetalleId
                                INNER JOIN wk_transaccion t ON t.transaccionId = td.transaccionId
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_etapa e ON a.etapaId = e.etapaId
                                INNER JOIN wk_proceso p ON e.procesoId = p.procesoId
                                WHERE MONTH (t.fechaInicio) = MONTH (NOW())
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function procesos()
    {
        $tr = $this->db->query("SELECT t.procesoId, p.nombreProceso as 'proceso'
                                FROM wk_transaccion t
                                INNER JOIN wk_transaccion_detalle td ON t.transaccionId = td.transaccionId
                                INNER JOIN wk_transaccion_actividades ta ON ta.transaccionDetalleId = td.transaccionDetalleId
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_etapa e ON a.etapaId = e.etapaId
                                INNER JOIN wk_proceso p ON e.procesoId = p.procesoId
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function reporteProceso($procesoId)
    {
        $tr = $this->db->query("SELECT  p.nombreProceso as 'proceso', e.nombreEtapa as 'etapa', a.nombreActividad as 'actividad',
                                (CASE
                                    WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    WHEN t.estadoTransaccion = 'I' THEN 'Inactivo'
                                    ELSE '-'
                                END) as 'estado', t.fechaInicio, t.horaInicio, t.fechaFin, t.horaFin
                                FROM wk_transaccion t
                                INNER JOIN wk_transaccion_detalle td ON t.transaccionId = td.transaccionId
                                INNER JOIN wk_transaccion_actividades ta ON ta.transaccionDetalleId = td.transaccionDetalleId
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_etapa e ON a.etapaId = e.etapaId
                                INNER JOIN wk_proceso p ON e.procesoId = p.procesoId
                                WHERE p.procesoId = $procesoId
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function reporteProcesoTiempo($fecha)
    {
        $fechas = explode("a", $fecha);

        $fechaI = $fechas[0];
        $fechaF = $fechas[1]; 

        /* $tr = $this->db->query("SELECT  p.nombreProceso as 'proceso', concat_ws(
                                    ' ',
                                    pe.nombres,
                                    pe.primerApellido
                                ) as 'persona', i.nombreInstitucion,
                                (CASE
                                    WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                    WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                    WHEN t.estadoTransaccion = 'I' THEN 'Inactivo'
                                    ELSE '-'
                                END) as 'estado', t.fechaInicio, t.fechaFin
                                FROM wk_transaccion t
                                INNER JOIN wk_transaccion_detalle td ON t.transaccionId = td.transaccionId
                                INNER JOIN wk_transaccion_actividades ta ON ta.transaccionDetalleId = td.transaccionDetalleId
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_etapa e ON a.etapaId = e.etapaId
                                INNER JOIN wk_proceso p ON e.procesoId = p.procesoId
                                INNER JOIN wk_persona pe ON pe.personaId = a.personaId
                                INNER JOIN wk_institucion i ON i.institucionId = t.institucionId
                                WHERE t.fechaInicio BETWEEN STR_TO_DATE('$fechaI', '%d-%m-%Y') 
                                AND  STR_TO_DATE('$fechaF', '%d-%m-%Y')
                                ORDER BY t.transaccionId");
        return $tr->getResult(); */
        return $fechaF;
    }

    public function reporteUsuario()
    {
        $tr = $this->db->query("SELECT u.usuario as 'usuario', 
                                concat_ws(
                                    ' ',
                                    p.nombres,
                                    p.primerApellido
                                ) as 'persona', if(p.genero = 'F', 'Femenino', 'Masculino') as 'genero', d.departamento as 'departamento', c.cargo as 'cargo',
                                if(u.estado = 'A', 'Activo', 'Inactivo') as 'estado'
                                FROM wk_usuario u
                                INNER JOIN wk_persona p ON u.personaId = p.personaId
                                INNER JOIN wk_rol r ON u.rolId = r.rolId
                                INNER JOIN wk_departamento d ON p.departamentoId = d.departamentoId
                                INNER JOIN wk_cargo c ON p.cargoId = c.cargoId
                                ORDER BY u.usuarioId");
        return $tr->getResult();
    }

    public function reporteProcesoAct($procesoId)
    {
        $tr = $this->db->query("SELECT  p.nombreProceso as 'proceso', e.nombreEtapa as 'etapa', a.nombreActividad as 'actividad',
                                concat_ws(
                                    ' ',
                                    pe.nombres,
                                    pe.primerApellido
                                ) as 'persona',
                                (CASE
                                    WHEN ta.estado = 'P' THEN 'En Progreso'
                                    WHEN ta.estado = 'F' THEN 'Finalizado'
                                    WHEN ta.estado = 'I' THEN 'Inactivo'
                                    ELSE '-'
                                END) as 'estado', 
                                if(ta.fechaInicio = (length(ta.fechaInicio)=0), '-', ta.fechaInicio) as 'fechaInicio', 
                                if(DATE_FORMAT(ta.horaInicio, '%H:%i') = (length(ta.horaInicio)=0), '-', DATE_FORMAT(ta.horaInicio, '%H:%i')) as 'horaInicio', 
                                if(ta.fechaFin = (length(ta.fechaFin)=0), '-', ta.fechaFin) as 'fechaFin', 
                                if(DATE_FORMAT(ta.horaFin, '%H:%i') = (length(ta.horaFin)=0), '-', DATE_FORMAT(ta.horaFin, '%H:%i')) as 'horaFin'
                                FROM wk_transaccion t
                                INNER JOIN wk_transaccion_detalle td ON t.transaccionId = td.transaccionId
                                INNER JOIN wk_transaccion_actividades ta ON ta.transaccionDetalleId = td.transaccionDetalleId
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona pe ON pe.personaId = a.personaId
                                INNER JOIN wk_etapa e ON a.etapaId = e.etapaId
                                INNER JOIN wk_proceso p ON e.procesoId = p.procesoId
                                WHERE e.procesoId = $procesoId");
        return $tr->getResult();
    }

}