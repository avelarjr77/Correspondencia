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
}