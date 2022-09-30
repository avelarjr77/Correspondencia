<?php

namespace App\Controllers\modTransaccion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modProceso\ProcesoModel;
use App\Models\modUsuario\ContactoModel;
use App\Models\modTransaccion\TransaccionConfigModel;

class TransaccionConfigController extends BaseController
{

    //LISTAR TRANSACCION

    public function index()
    {
        $nombreProceso = new TransaccionConfigModel();
        $datos = $nombreProceso->listarProceso();
        $institucion = $nombreProceso->listarInstitucion();
        $transaccion = $nombreProceso->transaccionData();
        $transaccionFin = $nombreProceso->transaccionDataFin();
        $persona = $nombreProceso->listarPersona();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "institucion" => $institucion,
            "transaccion" => $transaccion,
            "transaccionFin" => $transaccionFin,
            "persona" => $persona,
            "mensaje" => $mensaje
        ];

        return view('modTransaccion/transaccionConfig', $data);
    }

    public function etapas()
    {

        $etapa = new TransaccionConfigModel();
        $procesoId = $this->request->getVar('procesoId');

        $datos = $etapa->listarEtapa($procesoId);
        echo json_encode($datos);

    }

    public function tDetId()
    {
        $etapaDet = new TransaccionConfigModel();

        $etapaId = $etapaDet->obtenerTDID();

        echo json_encode($etapaId);
    }

    public function tAcId()
    {
        $etapaDetA = new TransaccionConfigModel();

        $actividadId = $etapaDetA->obtenerTAID();

        echo json_encode($actividadId);
    }

    public function actividad()
    {

        $actividad = new TransaccionConfigModel();
        $etapaId = $this->request->getVar('etapaId');
        $datos = $actividad->listarActividad($etapaId);

        echo json_encode($datos);
    }

    public function tDetalle()
    {

        $etapa = new TransaccionConfigModel();
        $transaccionId = $this->request->getVar('transaccionId');

        $etapaId = $this->request->getVar('etapaId');
        $fechaHora = date('Y-m-d H:i:s');
        $porciones = explode(" ", $fechaHora);

        $datos = [
            "estadoTransaccion" => 'P',
            "fechaInicio" => $porciones[0],
            "horaInicio" => $porciones[1]
        ];

        $data = [
            'transaccionId' => $transaccionId,
            'etapaId' => $etapaId,
            "estado" => 'P',
            "fechaInicio" => $porciones[0],
            "horaInicio" => $porciones[1]
        ];

        $insertar = $etapa->insertarT($data);

        $actalizarEstado = $etapa->actualizar($datos, $transaccionId);

        $tDetalle = $etapa->listarTransaccionDet($transaccionId);

        echo json_encode($tDetalle);
    }

    public function etapasList()
    {

        $etapaLista = new TransaccionConfigModel();
        $transaccionId = $this->request->getVar('transaccionId');


        $tDetalleList = $etapaLista->listarTransaccionDet($transaccionId);

        echo json_encode($tDetalleList);
    }

    public function tActividades()
    {

        $actividad = new TransaccionConfigModel();
        $transaccionDetalleId = $this->request->getVar('transaccionDetalleId');
        $actividadId = $this->request->getVar('actividadId');
        $fechaHora = date('Y-m-d H:i:s');
        $porciones = explode(" ", $fechaHora);

        //Campos de auditoria
        $hora=new Time('now');
        $session = session('usuario');

        $data = [
            'transaccionDetalleId' => $transaccionDetalleId,
            'actividadId' => $actividadId,
            "estado" => 'I',
            "fechaCreacion" => $porciones[0],
            "horaCreacion" => $porciones[1],
            "usuarioCrea" => $session,
            "fechaCrea" => $hora
        ];

        //obtener persona encargado
        $personaId =  $actividad->asArray()->select('a.personaId')
            ->from('wk_actividad a')->where('a.actividadId', $actividadId)->first();

        //obtener nombre de la actividad
        $nombreActividad =  $actividad->asArray()->select('a.nombreActividad')
            ->from('wk_actividad a')->where('a.actividadId', $actividadId)->first();

        //obtener descripcion de la actividad
        $descripcion =  $actividad->asArray()->select('a.descripcion')
            ->from('wk_actividad a')->where('a.actividadId', $actividadId)->first();

        $insertar = $actividad->insertarAct($data); //AQUI CREAR ACTIVIDAD

        if ($insertar) {

            $modelContacto = new ContactoModel();
            $anio = date('Y');

            $contactoA = $modelContacto->asArray()->select('c.contacto')->from('wk_contacto c')
                ->where('c.tipoContactoId', '1')->where('c.personaId', $personaId)->first();

            $msm = '
            <tbody>
                <tr>
                    <td style="background-color:#fff;text-align:left;padding:0">
                        <img width="100%" style="display:block" src="https://ci5.googleusercontent.com/proxy/P25cH7v50GgGMWFREqDuajcm2OkK3RY5n34zWsarDel-wtDsvs1Oljgt504DztdGajplibawaNrACXM7NVKg=s0-d-e1-ft#https://ucadvirtual.com/EduWS/encabezado.png" class="CToWUd a6T" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 816px; top: 64px;"><div id=":vp" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Descargar el archivo adjunto " data-tooltip-class="a1V" data-tooltip="Descargar"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
                    </td>
                <tr>
                <tr>
                    <td style="background-color:#ffffff">
                    <div style="color:#34495e;margin:4% 10% 2%;text-align:justify;font-family:sans-serif">
                        <h2 style="color:#003366;margin:0 0 7px">Buen día, estimado(a).</h2><br>
                        <p style="margin:2px;font-size:15px">
                            Se le ha asignado una actividad.<br><br>
                        </p>
                        <h1 style="font-weight:bold;text-align:center">' . $nombreActividad['nombreActividad'] . '</h1><br>
                        <h5 style="font-size:15px;font-weight:bold;text-align:center;">
                        <b>Descripcion:</b>' . $descripcion['descripcion'] . '</h5><br>
                        <div style="width:100%;text-align:center;margin-top:10%">
                            <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Correspondencia</a>
                        </div>
                        <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - ' . $anio . '</p>
                    </div>
                    </td>
                </tr>
            </tbody>
            ';
            $email = \Config\Services::email();
            $email->setFrom('correspondencia.ucad@gmail.com', 'Nueva Actividad Asignada: ' . $nombreActividad['nombreActividad']);
            $email->setTo($contactoA['contacto']);
            $email->setSubject('Nueva Actividad Asignada');
            $email->setMessage($msm);
            if ($email->send()) {
                $mensaje = 12;
            }
        } else {
            $mensaje = 13;
        }

        $tActDetalle = $actividad->listarTransaccionAct($transaccionDetalleId);

        echo json_encode($tActDetalle);
    }

    public function actividadList()
    {

        $actividadLista = new TransaccionConfigModel();
        $transaccionDetalleId = $this->request->getVar('transaccionDetalleId');


        $tActividadList = $actividadLista->listarTransaccionAct($transaccionDetalleId);

        echo json_encode($tActividadList);
    }

    public function transaccionListado()
    {

        $transaccion = new TransaccionConfigModel();
        $list = $transaccion->transaccionData();

        echo json_encode($list);
    }

    public function transaccionObservaciones()
    {

        $transaccionO = new TransaccionConfigModel();

        $transaccionId = $this->request->getVar('transaccionId');

        $respuesta = $transaccionO->transaccionDataO($transaccionId);

        echo json_encode($respuesta);
    }

    //CREAR TRANSACCION
    public function crear()
    {

        //Campos de auditoria
        $hora = new Time('now');
        $session = session('usuario');

        $datos = [
            "procesoId" => $_POST['procesoId'],
            "personaId" => $_POST['personaId'],
            "institucionId" => $_POST['institucionId'],
            "observaciones" => $_POST['observaciones'],
            "estadoTransaccion" => 'I',
            "usuarioCrea"   => $session,
            "fechaCrea"     => $hora
        ];

        $transaccion = new TransaccionConfigModel();

        $procesoId      = $_POST['procesoId'];
        $observaciones  = $_POST['observaciones'];

        $proceso = new ProcesoModel();

        $procesoNombre = $proceso->asArray()->select("nombreProceso")
            ->where("procesoId", $procesoId)->first();

        $respuesta = $transaccion->insertar($datos);

        //PARA REGISTRAR EN BITACORA QUIEN CREÓ LA TRANSACCION
        $this->bitacora  = new MovimientosModel();

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Creó Transacción de proceso',
            'descripcion'   => $procesoNombre['nombreProceso'] . '<br>' . $observaciones,
            'hora'          => $hora,
        ]);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '0');
        } else {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '1');
        }
    }

    //ELIMINAR TRANSACCION
    public function eliminarT()
    {

        $transaccion = new TransaccionConfigModel();

        $transaccionId = $this->request->getVar('transaccionId');

        $data = ["transaccionId" => $transaccionId];

        $respuesta = $transaccion->eliminarP($data);



        echo json_encode($respuesta);
    }

    public function eliminarP()
    {

        $transaccion = new TransaccionConfigModel();

        $transaccionId = $this->request->getVar('transaccionId');

        $datos = [
            "estadoTransaccion" => 'A'
        ];

        $respuesta = $transaccion->actualizar($datos, $transaccionId);

        $nombreTransaccion = $transaccion->asArray()->select("p.nombreProceso")
            ->from('wk_transaccion t')
            ->join('wk_proceso p', 'p.procesoId = t.procesoId')
            ->where("t.transaccionId", $transaccionId)->first();

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUE SE ANLÓ LA TRANSACCIÓN
        $this->bitacora  = new MovimientosModel();
        $hora = new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Anuló transacción',
            'descripcion'   => $nombreTransaccion,
            'hora'          => $hora,
        ]);
        //END

        echo json_encode($respuesta);
    }

    //ACTUALIZAR TRANSACCION
    public function actualizar()
    {
        $datos = [
            "estadoTransaccion" => 'P'
        ];

        $transaccionId = $this->request->getVar('transaccionId');

        $transaccion = new TransaccionConfigModel();
        $respuesta = $transaccion->actualizar($datos, $transaccionId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '5');
        }
    }

    //ACTUALIZAR OBSERVACIONES
    public function actualizarO()
    {
        //Campos de auditoria
        $hora = new Time('now');
        $session = session('usuario');

        $datos = [
            "observaciones" => $_POST['observaciones'],
            "usuarioModifica"   => $session,
            "fechaModifica"     => $hora,
        ];

        $transaccionId = $_POST['transaccionId'];

        $transaccion = new TransaccionConfigModel();
        $respuesta = $transaccion->actualizar($datos, $transaccionId);

        $nombreTransaccion = $transaccion->asArray()->select("p.nombreProceso")
            ->from('wk_transaccion t')
            ->join('wk_proceso p', 'p.procesoId = t.procesoId')
            ->where("t.transaccionId", $transaccionId)->first();

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ Las observaciones
        $this->bitacora  = new MovimientosModel();
        $hora = new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó observación',
            'descripcion'   => $nombreTransaccion['nombreProceso'] . ': <br>' . $_POST['observaciones'],
            'hora'          => $hora,
        ]);


        if ($respuesta) {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/transaccionConfig')->with('mensaje', '5');
        }
    }
}

?>