<?php namespace App\Controllers\modTransaccion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modTransaccion\TransaccionConfigModel;
use App\Models\modTransaccion\TransaccionActividadModel;

class TransaccionActividadController extends BaseController{

    //LISTAR TRANSACCION

    public function index(){
        $session = session();
        $tActividad = new TransaccionActividadModel();

        $etapaId = $_GET['etapaId'];

        $mensaje = session('mensaje');

        $personaId =  $tActividad->asArray()->select('p.personaId')->from('wk_usuario u')
            ->join('wk_persona p', 'u.personaId = p.personaId')->where('u.usuario', $session->usuario)->first();

        $data = [
            "datos" => $tActividad->asObject()->select('ta.transaccionActividadId as id, a.nombreActividad as actividad, ta.actividadId, 
                ta.fechaInicio, ta.fechaFin, ta.horaInicio, ta.horaFin, ta.fechaCreacion, ta.horaCreacion, p.nombres as persona, a.personaId, 
                (CASE
                    WHEN ta.estado = "P" THEN "En Progreso"
                    WHEN ta.estado = "F" THEN "Finalizado"
                    ELSE "Inactivo"
                END)  as estado, ta.transaccionDetalleId, a.etapaId, e.nombreEtapa, a.ordenActividad,
                e.procesoId, pr.nombreProceso, e.orden as ordenEtapa, t.transaccionId, ta.observaciones')
                ->from('wk_transaccion_actividades ta')
                ->join('wk_actividad a', 'a.actividadId = ta.actividadId')
                ->join('wk_etapa e', 'e.etapaId = a.etapaId')
                ->join('wk_proceso pr', 'pr.procesoId = e.procesoId')
                ->join('wk_persona p', 'p.personaId = a.personaId')
                ->join('wk_transaccion_detalle t', 't.transaccionDetalleId = ta.transaccionDetalleId')
                ->where('p.personaId', $personaId)
                ->where('t.etapaId', $etapaId)
                ->orderBy('a.ordenActividad')
                ->groupBy('ta.transaccionActividadId')
                ->findAll(),
            "doc" => $tActividad->asObject()->select('*')
                ->from('wk_documento d')
                ->orderBy('d.documentoId')
                ->groupBy('d.documentoId')
                ->findAll(),
            "tipoDoc" => $tActividad->asObject()->select('*')
                ->from('wk_tipo_documento td')
                ->groupBy('td.tipoDocumentoId')
                ->findAll(),
            "tipoEnvio" => $tActividad->asObject()->select('*')
                ->from('wk_tipo_envio te')
                ->groupBy('te.tipoEnvioId')
                ->findAll(),
            "titulos" => $tActividad->asObject()->select('t.procesoId, pp.nombreProceso, td.etapaId, e.nombreEtapa')
                ->from('wk_transaccion_actividades ta')
                ->join('wk_actividad a', 'a.actividadId = ta.actividadId')
                ->join('wk_etapa e', 'e.etapaId = a.etapaId')
                ->join('wk_proceso pp', 'pp.procesoId = e.procesoId')
                ->join('wk_persona p', 'p.personaId = a.personaId')
                ->join('wk_transaccion_detalle td', 'td.transaccionDetalleId = ta.transaccionDetalleId')
                ->join('wk_transaccion t', 't.transaccionId = td.transaccionId')
                ->where('p.personaId', $personaId)
                ->where('td.etapaId', $etapaId)
                ->groupBy('td.etapaId')
                ->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modTransaccion/transaccionActividad', $data);
    }

   //TRANSACCION
   public function finalizarA()
   {

        $transaccion = new TransaccionActividadModel();
        $transaccionConfig = new TransaccionConfigModel();
        
        $etapaId = $this->request->getVar('etapaId');
        $ordenActividad = $this->request->getVar('ordenActividad');
        $procesoId = $this->request->getVar('procesoId');
        $ordenEtapa = $this->request->getVar('ordenEtapa');
        $transaccionId = $this->request->getVar('transaccionId');
        $transaccionDetalleId = $this->request->getVar('transaccionDetalleId');
        $transaccionActividadId = $this->request->getVar('transaccionActividadId');
        $fechaHora = date('Y-m-d H:i:s');
        $porciones = explode(" ", $fechaHora);
        $transaccionDetalle= $transaccionDetalleId +1;

        //obtener actividadId que sigue en el orden
        $actividadId =  $transaccion->asArray()->select('vp.actividadId')
        ->from('vista_con_procesos vp')->where('vp.etapaId', $etapaId)
        ->where('vp.ordenActividad >', $ordenActividad)->orderBy('vp.ordenActividad')->first();

        //obtener etapaId que sigue en el orden
        $etapa =  $transaccion->asArray()->select('vp.etapaId')
        ->from('vista_con_procesos vp')->where('vp.procesoId', $procesoId)
        ->where('vp.ordenEtapa >', $ordenEtapa)->orderBy('vp.ordenEtapa')->first();

        //obtener actividadId que segun etapa encontrada
        $actividad =  $transaccion->asArray()->select('vp.actividadId')
        ->from('vista_con_procesos vp')->where('vp.etapaId', $etapa)->orderBy('vp.ordenActividad')->first();

        //$respuesta = $transaccion->obtenerActividadOrden($etapaId, $ordenActividad);

        $datos = [ 
            "estado" => 'F',
            "fechaFin" => $porciones[0],
            "horaFin" => $porciones[1]
        ]; //etapa y actividad finalizar

        $datosP = [ 
            "estadoTransaccion" => 'F',
            "fechaFin" => $porciones[0],
            "horaFin" => $porciones[1]
        ]; //proceso

        $data = [
            'transaccionDetalleId' => $transaccionDetalleId, 
            'actividadId' => $actividadId,
            "estado" => 'I',
            "fechaCreacion" => $porciones[0],
            "horaCreacion" => $porciones[1]
        ]; //actividad

        $dataAN = [
            'transaccionDetalleId' => $transaccionDetalle, 
            'actividadId' => $actividad,
            "estado" => 'I',
            "fechaCreacion" => $porciones[0],
            "horaCreacion" => $porciones[1]
        ]; //actividad etapa nueva

        $dataE = [
            'transaccionId' => $transaccionId, 
            'etapaId' => $etapa,
            "estado" => 'I',
            "fechaInicio" => $porciones[0],
            "horaInicio" => $porciones[1]
        ]; //etapa

        if ($actividadId == '') {
            if ($etapa == '') {
                $actalizarEstadoAc = $transaccionConfig->actualizarA($datos, $transaccionActividadId); // finalizo actividad
                $actalizarEstadoE = $transaccionConfig->actualizarT($datos, $transaccionDetalleId);//finalizo etapa
                $actalizarEstadoP = $transaccionConfig->actualizar($datosP, $transaccionId);// finalizo proceso
            }else{
                $actalizarEstadoE = $transaccionConfig->actualizarT($datos, $transaccionDetalleId);//finalizo etapa
                $actalizarEstadoAc = $transaccionConfig->actualizarA($datos, $transaccionActividadId); //finalizo actividad
                $insertarEtapa = $transaccionConfig->insertarT($dataE); //insertar etapa
                $insertarAN = $transaccionConfig->insertarAct($dataAN); //insertar actividad
            }
        }else{
            $insertar = $transaccionConfig->insertarAct($data); //insertar actividad
            $actalizarEstadoA = $transaccionConfig->actualizarA($datos, $transaccionActividadId); //actividad
        }

        $lista = $transaccionConfig->listarTransaccionAct($transaccionDetalleId);

        echo json_encode($etapaId);
    }
    
    public function iniciarActividad(){

        $actividadI = new TransaccionConfigModel();
        $transaccionActividadId = $this->request->getVar('transaccionActividadId');
        $etapaId = $this->request->getVar('etapaId');
        $fechaHora = date('Y-m-d H:i:s');
        $porciones = explode(" ", $fechaHora);

        $datos = [ 
            "estado" => 'P',
            "fechaInicio" => $porciones[0],
            "horaInicio" => $porciones[1]
        ];

        $tActDetalle = $actividadI->actualizarA($datos, $transaccionActividadId);
        
        echo json_encode($etapaId);
    }

    public function docLista(){

        $transaccion = new TransaccionActividadModel();
        $transaccionActividadId = $this->request->getVar('transaccionActividadId');

        $datos = $transaccion->docLista($transaccionActividadId);
        
        echo json_encode($datos);
    }

    public function docVista(){

        $transaccion = new TransaccionActividadModel();
        $documentoId = $this->request->getVar('documentoId');

        $datos = $transaccion->docVista($documentoId);
        
        echo json_encode($datos);
    }

    //CREAR TRANSACCION
    public function crear(){

        $datos = [
            "procesoId" => $_POST['procesoId'],
            "personaId" => $_POST['personaId'],
            "institucionId" => $_POST['institucionId']
        ];

        $transaccion = new TransaccionActividadModel();
        $respuesta = $transaccion->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/transaccionConfig')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/transaccionConfig')->with('mensaje','1');
        } 
    } 

    //ELIMINAR TRANSACCION
    public function eliminarP(){

        $transaccion = new TransaccionActividadModel();
        
        $transaccionId = $this->request->getVar('transaccionId');

        $data = ["transaccionId" => $transaccionId];

        $respuesta = $transaccion->eliminarP($data);

        echo json_encode($respuesta);
    }

    //ACTUALIZAR TRANSACCION
    public function actualizar()
    {
        $datos = [
            "estadoTransaccion" => 'P'
        ];

        $transaccionId = $this->request->getVar('transaccionId');

        $transaccion = new TransaccionActividadModel();
        $respuesta = $transaccion->actualizar($datos, $transaccionId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '5');
        }
    }

    public function actualizarO()
    {
        $datos = [
            "observaciones" => $_POST['observaciones']
        ];

        $transaccionActividadId = $_POST['transaccionActividadId'];
        $etapaId = $_POST['etapaId'];

        $transaccion = new TransaccionActividadModel();
        $respuesta = $transaccion->actualizarO($datos, $transaccionActividadId);

        $nombreTransaccion = $transaccion->asArray()->select("a.nombreActividad")
        ->from('wk_transaccion_actividades t')
        ->join('wk_actividad a', 'a.actividadId = t.actividadId')
        ->where("t.transaccionActividadId", $transaccionActividadId)->first();

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ Las observaciones
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó observación',
            'descripcion'   => $nombreTransaccion['nombreActividad'].': <br>'.$_POST['observaciones'],
            'hora'          => $hora,
        ]);

        if ($respuesta) {
            return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapaId)->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapaId)->with('mensaje', '5');
        }
    }

    
}

?>