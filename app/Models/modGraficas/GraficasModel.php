<?php

namespace App\Models\modGraficas;

use CodeIgniter\Model;

class GraficasModel extends Model
{
    protected $table = 'wk_transaccion_actividades';
    protected $primaryKey = 'transaccionActividadId';
    protected $allowedFields = ['transaccionActividadId', 'transaccionDetalleId', 'actividadId', 'fechaInicio', 'fechaFin', 'horaInicio', 'horaFin', 'estado', 'observaciones'];

    public function bar()
    {
        $tr = $this->db->query("SELECT COUNT(*) as 'total', p.nombres as 'persona'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

    public function barra($fechaI, $fechaF)
    {
        //$fecha=explode(" - ", $fechas);

        $tr = $this->db->query("SELECT COUNT(*) as 'total', p.nombres as 'persona'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                WHERE ta.fechaInicio BETWEEN STR_TO_DATE('$fechaI', '%d/%m/%Y') 
                                AND  STR_TO_DATE('$fechaF', '%d/%m/%Y')
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

    public function line()
    {
        $ln = $this->db->query("SELECT  
                                (CASE
                                    WHEN MONTH(ta.fechaInicio) = 1 THEN 'Enero'
                                    WHEN MONTH(ta.fechaInicio) = 2 THEN 'Febrero'
                                    WHEN MONTH(ta.fechaInicio) = 3 THEN 'Marzo'
                                    WHEN MONTH(ta.fechaInicio) = 4 THEN 'Abril'
                                    WHEN MONTH(ta.fechaInicio) = 5 THEN 'Mayo'
                                    WHEN MONTH(ta.fechaInicio) = 6 THEN 'Junio'
                                    WHEN MONTH(ta.fechaInicio) = 7 THEN 'Julio'
                                    WHEN MONTH(ta.fechaInicio) = 8 THEN 'Agosto'
                                    WHEN MONTH(ta.fechaInicio) = 9 THEN 'Septiembre'
                                    WHEN MONTH(ta.fechaInicio) = 10 THEN 'Octubre'
                                    WHEN MONTH(ta.fechaInicio) = 11 THEN 'Noviembre'
                                    ELSE 'Diciembre'
                                END) as mes, 
                                COUNT(ta.actividadId) as 'total'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                GROUP BY mes
                                ORDER BY ta.transaccionActividadId");
        return $ln->getResult();
    }

    public function progreso()
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN ta.estado = 'P' THEN 'En Progreso'
                                WHEN ta.estado = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion_actividades ta
                                WHERE estado = 'P'");
        return $ln->getResult();
    }

    public function inactivo()
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN ta.estado = 'P' THEN 'En Progreso'
                                WHEN ta.estado = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion_actividades ta
                                WHERE estado = 'I'");
        return $ln->getResult();
    }

    public function finalizado()
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN ta.estado = 'P' THEN 'En Progreso'
                                WHEN ta.estado = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion_actividades ta
                                WHERE estado = 'F'");
        return $ln->getResult();
    }
}