<?php namespace App\Controllers\modTransaccion;

use App\Controllers\BaseController;
use App\Models\modTransaccion\TransaccionListModel;

class TransaccionListController extends BaseController{

    //LISTAR TRANSACCION

    public function list(){
        $session = session();
        $tActividad = new TransaccionListModel();

        $mensaje = session('mensaje');

        $personaId =  $tActividad->asArray()->select('p.personaId')->from('wk_usuario u')
            ->join('wk_persona p', 'u.personaId = p.personaId')->where('u.usuario', $session->usuario)->first();

        $data = [
            "datos" => $tActividad->asObject()->select('ta.transaccionActividadId as id, a.nombreActividad as actividad, ta.actividadId, p.nombres as persona, a.personaId, td.etapaId, e.nombreEtapa,
                t.procesoId, pp.nombreProceso')
                ->from('wk_transaccion_actividades ta')
                ->join('wk_actividad a', 'a.actividadId = ta.actividadId')
                ->join('wk_etapa e', 'e.etapaId = a.etapaId')
                ->join('wk_proceso pp', 'pp.procesoId = e.procesoId')
                ->join('wk_persona p', 'p.personaId = a.personaId')
                ->join('wk_transaccion_detalle td', 'td.transaccionDetalleId = ta.transaccionDetalleId')
                ->join('wk_transaccion t', 't.transaccionId = td.transaccionId')
                ->where('p.personaId', $personaId)
                ->orderBy('td.etapaId')
                ->groupBy('t.transaccionId')
                ->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modTransaccion/transaccionLista', $data);
    }

}
?>