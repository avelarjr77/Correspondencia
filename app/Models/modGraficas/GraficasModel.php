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
        $tr = $this->db->query("SELECT COUNT(*) as 'total',p.nombres as 'persona'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                WHERE ta.fechaInicio BETWEEN STR_TO_DATE('$fechaI', '%d/%m/%Y') 
                                AND  STR_TO_DATE('$fechaF', '%d/%m/%Y')
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

    public function barraE($fechaI, $fechaF)
    {
        $tr = $this->db->query("SELECT COUNT(*) as 'total',p.nombres as 'persona'
                                FROM wk_transaccion t
                                INNER JOIN wk_persona p ON p.personaId = t.personaId
                                WHERE t.fechaInicio BETWEEN STR_TO_DATE('$fechaI', '%d/%m/%Y') 
                                AND  STR_TO_DATE('$fechaF', '%d/%m/%Y')
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

    public function barraP($fechaI, $fechaF)
    {
        $tr = $this->db->query("SELECT p.nombreProceso as 'proceso', ROUND(DATEDIFF(t.fechaFin, t.fechaInicio)) as 'tiempo'
                                FROM wk_transaccion t
                                INNER JOIN wk_proceso p ON p.procesoId = t.procesoId
                                INNER JOIN wk_institucion i ON i.institucionId = t.institucionId
                                INNER JOIN wk_persona pe ON pe.personaId = t.personaId
                                WHERE t.estadoTransaccion = 'F' AND t.fechaInicio BETWEEN STR_TO_DATE('$fechaI', '%d/%m/%Y') 
                                AND  STR_TO_DATE('$fechaF', '%d/%m/%Y')
                                ORDER BY t.transaccionId");
        return $tr->getResult();
    }

    public function barraProm($fechaI, $fechaF)
    {
        $tr = $this->db->query("SELECT p.nombres as 'persona', 
                                DATEDIFF(ta.fechaFin, ta.fechaInicio) as 'promedio'
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                WHERE ta.estado = 'F' AND ta.fechaInicio 
                                BETWEEN STR_TO_DATE('$fechaI', '%d/%m/%Y') 
                                AND  STR_TO_DATE('$fechaF', '%d/%m/%Y')
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

    public function barraProcesoPersona()
    {
        $tr = $this->db->query("SELECT p.nombres as 'persona', 
                                COUNT(*) as 'total'
                                FROM wk_transaccion t
                                INNER JOIN wk_persona p ON p.personaId = t.personaId
                                WHERE t.estadoTransaccion = 'F' AND MONTH (t.fechaInicio) = MONTH (NOW())
                                GROUP BY p.personaId
                                ORDER BY p.personaId");
        return $tr->getResult();
    }

    public function pastelG()
    {
        $tr = $this->db->query("SELECT COUNT(*) as 'total', 
                                if(p.genero = 'F', 'Femenino', 'Masculino') as 'genero'
                                FROM wk_usuario u
                                INNER JOIN wk_persona p ON u.personaId = p.personaId
                                GROUP BY p.genero");
        return $tr->getResult();
    }

    public function pastelE()
    {
        $tr = $this->db->query("SELECT COUNT(*) as 'totalE', 
                                if( u.estado = 'A', 'Activo', 'Inactivo') as 'estado'
                                FROM wk_usuario u
                                GROUP BY u.estado");
        return $tr->getResult();
    }

    public function departamento()
    {
        $tr = $this->db->query("SELECT COUNT(*) as 'totalD', d.departamento as 'departamento'
                                FROM wk_usuario u
                                INNER JOIN wk_persona p ON u.personaId = p.personaId
                                INNER JOIN wk_departamento d ON p.departamentoId = d.departamentoId
                                GROUP BY d.departamento");
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
                                WHERE YEAR (ta.fechaFin) = YEAR (NOW())
                                GROUP BY mes
                                ORDER BY ta.fechaInicio");
        return $ln->getResult();
    }

    public function progreso($personaId)
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN ta.estado = 'P' THEN 'En Progreso'
                                WHEN ta.estado = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                INNER JOIN wk_usuario u ON p.personaId = u.personaId
                                WHERE ta.estado = 'P' AND u.personaId = $personaId AND MONTH (ta.fechaInicio) = MONTH (NOW())");
        return $ln->getResult();
    }

    public function inactivo($personaId)
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN ta.estado = 'P' THEN 'En Progreso'
                                WHEN ta.estado = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                INNER JOIN wk_usuario u ON p.personaId = u.personaId
                                WHERE ta.estado = 'I' AND u.personaId = $personaId AND MONTH (ta.fechaCreacion) = MONTH (NOW())");
        return $ln->getResult();
    }

    public function finalizado($personaId)
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN ta.estado = 'P' THEN 'En Progreso'
                                WHEN ta.estado = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion_actividades ta
                                INNER JOIN wk_actividad a ON a.actividadId = ta.actividadId
                                INNER JOIN wk_persona p ON p.personaId = a.personaId
                                INNER JOIN wk_usuario u ON p.personaId = u.personaId
                                WHERE ta.estado = 'F' AND u.personaId = $personaId AND  MONTH (ta.fechaFin) = MONTH (NOW())");
        return $ln->getResult();
    }

    public function progresoP($personaId)
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion t
                                INNER JOIN wk_persona p ON p.personaId = t.personaId
                                INNER JOIN wk_usuario u ON p.personaId = u.personaId

                                WHERE estadoTransaccion = 'P' AND u.personaId = $personaId AND MONTH (t.fechaInicio) = MONTH (NOW())");
        return $ln->getResult();
    }

    public function inactivoP($personaId)
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion t
                                INNER JOIN wk_persona p ON p.personaId = t.personaId
                                INNER JOIN wk_usuario u ON p.personaId = u.personaId
                                WHERE estadoTransaccion = 'I' AND u.personaId = $personaId AND MONTH (t.fechaInicio) = MONTH (NOW())");
        return $ln->getResult();
    }

    public function finalizadoP($personaId)
    {
        $ln = $this->db->query("SELECT COUNT(*) as 'total', 
                                (CASE
                                WHEN t.estadoTransaccion = 'P' THEN 'En Progreso'
                                WHEN t.estadoTransaccion = 'F' THEN 'Finalizado'
                                ELSE 'Inactivo'
                                END) as 'estado' 
                                FROM wk_transaccion t
                                INNER JOIN wk_persona p ON p.personaId = t.personaId
                                INNER JOIN wk_usuario u ON p.personaId = u.personaId
                                WHERE estadoTransaccion = 'F' AND u.personaId = $personaId AND MONTH (t.fechaFin) = MONTH (NOW())");
        return $ln->getResult();
    }
}