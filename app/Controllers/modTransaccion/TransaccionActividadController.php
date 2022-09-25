<?php namespace App\Controllers\modTransaccion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modTransaccion\TransaccionConfigModel;
use App\Models\modUsuario\ContactoModel;
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
                    ta.fechaInicio, ta.fechaFin, ta.horaInicio, ta.horaFin, ta.fechaCreacion, ta.horaCreacion, p.nombres as persona, p.primerApellido as apellido, a.personaId, 
                    (CASE
                        WHEN ta.estado = "P" THEN "En Progreso"
                        WHEN ta.estado = "F" THEN "Finalizado"
                        ELSE "Inactivo"
                    END)  as estado, ta.transaccionDetalleId, a.etapaId, e.nombreEtapa, a.ordenActividad, t.personaId as encargado,
                    e.procesoId, pr.nombreProceso, e.orden as ordenEtapa, t.transaccionId, ta.observaciones, a.descripcion')
                    ->from('wk_transaccion_actividades ta')
                    ->join('wk_actividad a', 'a.actividadId = ta.actividadId')
                    ->join('wk_etapa e', 'e.etapaId = a.etapaId')
                    ->join('wk_proceso pr', 'pr.procesoId = e.procesoId')
                    ->join('wk_persona p', 'p.personaId = a.personaId')
                    ->join('wk_transaccion_detalle td', 'td.transaccionDetalleId = ta.transaccionDetalleId')
                    ->join('wk_transaccion t', 't.transaccionId = td.transaccionId')
                    ->where('p.personaId', $personaId)
                    ->where('td.etapaId', $etapaId)
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
        $actividadIdentificador = $this->request->getVar('actividadId');
        $nombreProceso = $this->request->getVar('nombreProceso');
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

        //obtener persona encargado del proceso
        $procesoPersona =  $transaccion->asArray()->select('t.personaId')
        ->from('wk_transaccion t')->where('t.transaccionId', $transaccionId)->first();

        //obtener persona de la actividad a insertar en funcion insertar
        $personaActA =  $transaccion->asArray()->select('vp.personaId')->from('vista_con_procesos vp')
        ->where('vp.actividadId', $actividadId)->first();

        //obtener datos de la actividad a insertar en funcion insertar
        $datosCorreo1 =  $transaccion->asArray()->select('vp.nombreActividad as nombreActividadA,
        vp.descripcion as descripcionA, vp.nombreProceso as nombreProcesoA')->from('vista_con_procesos vp')
        ->where('vp.actividadId', $actividadId)->first();

        //obtener persona de la actividad a insertar en funcion insertarAN
        $personaActB =  $transaccion->asArray()->select('vp.personaId')->from('vista_con_procesos vp')
        ->where('vp.actividadId', $actividad)->first();

        //obtener datos de la actividad a insertar en funcion insertarAN
        $datosCorreo2 =  $transaccion->asArray()->select('vp.nombreActividad as nombreActividadB,
        vp.descripcion as descripcionB, vp.nombreProceso as nombreProcesoB')->from('vista_con_procesos vp')
        ->where('vp.actividadId', $actividad)->first();

        //Campos de auditoria
        $hora=new Time('now');
        $session = session('usuario');

        $datos = [ 
            "estado" => 'F',
            "fechaFin" => $porciones[0],
            "horaFin" => $porciones[1],
            "usuarioModifica"   => $session,
            "fechaModifica"     => $hora,
        ]; //etapa y actividad finalizar

        $datosP = [ 
            "estadoTransaccion" => 'F',
            "fechaFin" => $porciones[0],
            "horaFin" => $porciones[1]
        ]; //proceso

        //Campos de auditoria
        $hora=new Time('now');
        $session = session('usuario');

        $data = [
            'transaccionDetalleId' => $transaccionDetalleId, 
            'actividadId' => $actividadId,
            "estado" => 'I',
            "fechaCreacion" => $porciones[0],
            "horaCreacion" => $porciones[1],
            "usuarioModifica"   => $session,
            "fechaModifica"     => $hora,
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
            "horaInicio" => $porciones[1],
            "usuarioModifica"   => $session,
            "fechaModifica"     => $hora,
        ]; //etapa

        if ($actividadId == '') {
            if ($etapa == '') {
                $actalizarEstadoAc = $transaccionConfig->actualizarA($datos, $transaccionActividadId); // finalizo actividad
                $actalizarEstadoE = $transaccionConfig->actualizarT($datos, $transaccionDetalleId);//finalizo etapa
                
                if ($actalizarEstadoE) {
                    $model = new ContactoModel();
                    $anio = date('Y');

                    //obtener persona de la actividad a insertar en funcion insertar
                    $nombreEtapa =  $transaccion->asArray()->select('vp.nombreEtapa')->from('vista_con_procesos vp')
                    ->where('vp.etapaId', $etapaId)->first();
        
                    $contacto = $model->asArray()->select('c.contacto')->from('wk_contacto c')
                    ->where('c.tipoContactoId','1')->where('c.personaId', $procesoPersona)->first();
        
                    $msm ='
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
                                    Se le ha informa que ha finalizado la etapa:'.$nombreEtapa['nombreEtapa'].' del proceso: "'.$nombreProceso.'"<br>
                                </p>
                                <p style="margin:2px;font-size:15px"></p><p style="margin:2px;font-size:15px;font-weight:bold;display:inline">
                                
                                <div style="width:100%;text-align:center;margin-top:10%">
                                    <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                                </div>
                                <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - '.$anio.'</p>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                    ';
                    $email = \Config\Services::email();
                    $email->setFrom('correspondencia.ucad@gmail.com', 'Etapa finalizada: '.$nombreEtapa['nombreEtapa']);
                    $email->setTo($contacto['contacto']);
                    $email->setSubject('Etapa Finalizada');
                    $email->setMessage($msm);
                    if ($email->send()) {
                        $mensaje = 12;
                    }
                }else{
                    $mensaje = 12;
                }

                $actalizarEstadoP = $transaccionConfig->actualizar($datosP, $transaccionId);// finalizo proceso AQUI
                
                if ($actalizarEstadoP) {
                    $model = new ContactoModel();
                    $anio = date('Y');
        
                    $contacto = $model->asArray()->select('c.contacto')->from('wk_contacto c')
                    ->where('c.tipoContactoId','1')->where('c.personaId', $procesoPersona)->first();
        
                    $msm ='
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
                                    Se le ha informa que ha finalizado el proceso:'.$nombreProceso.'<br>
                                </p>
                                <p style="margin:2px;font-size:15px"></p><p style="margin:2px;font-size:15px;font-weight:bold;display:inline">
                                
                                <div style="width:100%;text-align:center;margin-top:10%">
                                    <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                                </div>
                                <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - '.$anio.'</p>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                    ';
                    $email = \Config\Services::email();
                    $email->setFrom('correspondencia.ucad@gmail.com', 'Proceso finalizado: '.$nombreProceso);
                    $email->setTo($contacto['contacto']);
                    $email->setSubject('Proceso Finalizado');
                    $email->setMessage($msm);
                    if ($email->send()) {
                        $mensaje = 12;
                    }
                }else{
                    $mensaje = 12;
                }

            }else{
                $actalizarEstadoE = $transaccionConfig->actualizarT($datos, $transaccionDetalleId);//finalizo etapa

                if ($actalizarEstadoE) {
                    $model = new ContactoModel();
                    $anio = date('Y');

                    //obtener persona de la actividad a insertar en funcion insertar
                    $nombreEtapa =  $transaccion->asArray()->select('vp.nombreEtapa')->from('vista_con_procesos vp')
                    ->where('vp.etapaId', $etapaId)->first();
        
                    $contacto = $model->asArray()->select('c.contacto')->from('wk_contacto c')
                    ->where('c.tipoContactoId','1')->where('c.personaId', $procesoPersona)->first();
        
                    $msm ='
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
                                    Se le ha informa que ha finalizado la etapa:'.$nombreEtapa['nombreEtapa'].' del proceso: '.$nombreProceso.'<br>
                                </p>
                                <p style="margin:2px;font-size:15px"></p><p style="margin:2px;font-size:15px;font-weight:bold;display:inline">
                                
                                <div style="width:100%;text-align:center;margin-top:10%">
                                    <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                                </div>
                                <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - '.$anio.'</p>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                    ';
                    $email = \Config\Services::email();
                    $email->setFrom('correspondencia.ucad@gmail.com', 'Etapa finalizada: '.$nombreEtapa['nombreEtapa']);
                    $email->setTo($contacto['contacto']);
                    $email->setSubject('Etapa Finalizada');
                    $email->setMessage($msm);
                    if ($email->send()) {
                        $mensaje = 12;
                    }
                }else{
                    $mensaje = 12;
                }

                $actalizarEstadoAc = $transaccionConfig->actualizarA($datos, $transaccionActividadId); //finalizo actividad
                $insertarEtapa = $transaccionConfig->insertarT($dataE); //insertar etapa
                $insertarAN = $transaccionConfig->insertarAct($dataAN); //insertar actividad

                if ($insertarAN) {

                    $modelContacto = new ContactoModel();
                    $anio = date('Y');
        
                    $contactoA = $modelContacto->asArray()->select('c.contacto')->from('wk_contacto c')
                    ->where('c.tipoContactoId','1')->where('c.personaId', $personaActB)->first();
        
                    $msmA ='
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
                                <h5 style="margin:2px;font-size:15px">
                                Se le ha asignado una actividad.<br><br>
                                Actividad: '.$datosCorreo2['nombreActividadB'].'<br>
                                </h5>
                                <h5 style="margin:2px;font-size:15px">Descripcion: '.$datosCorreo2['descripcionB'].'</h5>
                                <br>
                                <h5 style="margin:2px;font-size:15px">Proceso: '.$datosCorreo2['nombreProcesoB'].'</h5><br>
                                
                                <div style="width:100%;text-align:center;margin-top:10%">
                                    <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                                </div>
                                <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - '.$anio.'</p>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                    ';
                    $email = \Config\Services::email();
                    $email->setFrom('correspondencia.ucad@gmail.com', 'Nueva Actividad Asignada: '.$datosCorreo2['nombreActividadB']);
                    $email->setTo($contactoA['contacto']);
                    $email->setSubject('Nueva Actividad Asignada');
                    $email->setMessage($msmA);
                    if ($email->send()) {
                        $mensaje = 12;
                    }
                }else{
                    $mensaje = 12;
                }

            }
        }else{
            $insertar = $transaccionConfig->insertarAct($data); //insertar actividad

            if ($insertar) {

                $modelContacto = new ContactoModel();
                $anio = date('Y');
    
                $contactoA = $modelContacto->asArray()->select('c.contacto')->from('wk_contacto c')
                ->where('c.tipoContactoId','1')->where('c.personaId', $personaActA)->first();
    
                $msmA ='
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
                            <h5 style="margin:2px;font-size:15px">
                                Se le ha asignado una actividad.<br><br>
                                Actividad: '.$datosCorreo1['nombreActividadA'].'<br>
                            </h5>
                            <h5 style="margin:2px;font-size:15px">Descripcion: '.$datosCorreo1['descripcionA'].'</h5>
                            <br>
                            <h5 style="margin:2px;font-size:15px">Proceso: '.$datosCorreo1['nombreProcesoA'].'</h5><br>
                            
                            <div style="width:100%;text-align:center;margin-top:10%">
                                <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                            </div>
                            <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - '.$anio.'</p>
                        </div>
                        </td>
                    </tr>
                </tbody>
                ';
                $email = \Config\Services::email();
                $email->setFrom('correspondencia.ucad@gmail.com', 'Nueva Actividad Asignada: '.$datosCorreo1['nombreActividadA']);
                $email->setTo($contactoA['contacto']);
                $email->setSubject('Nueva Actividad Asignada');
                $email->setMessage($msmA);
                if ($email->send()) {
                    $mensaje = 12;
                }
            }else{
                $mensaje = 12;
            }

            $actalizarEstadoA = $transaccionConfig->actualizarA($datos, $transaccionActividadId); //actividad AQUI
        }

        $lista = $transaccionConfig->listarTransaccionAct($transaccionDetalleId);

        echo json_encode($etapaId);
    }
    
    public function iniciarActividad(){

        $actividadI = new TransaccionConfigModel();
        $transaccionActividadId = $this->request->getVar('transaccionActividadId');
        $transaccionDetalleId = $this->request->getVar('transaccionDetalleId');
        $transaccionId = $this->request->getVar('transaccionId');
        $etapaId = $this->request->getVar('etapaId');
        $procesoId = $this->request->getVar('procesoId');
        $nombreProceso = $this->request->getVar('nombreProceso');
        $encargado = $this->request->getVar('encargado');
        $persona = $this->request->getVar('persona');
        $apellido = $this->request->getVar('apellido');
        $actividad = $this->request->getVar('actividad');
        $fechaHora = date('Y-m-d H:i:s');
        $porciones = explode(" ", $fechaHora);

        $datos = [ 
            "estado" => 'P',
            "fechaInicio" => $porciones[0],
            "horaInicio" => $porciones[1]
        ];

        $tActDetalle = $actividadI->actualizarA($datos, $transaccionActividadId);

        //obtener persona el id de la primera actividad
        $transaccionActId =  $actividadI->asArray()->select('MIN(ta.transaccionActividadId) as transaccionActId')
        ->from('wk_transaccion_actividades ta')->join('wk_transaccion_detalle td', 'td.transaccionDetalleId = ta.transaccionDetalleId')
        ->join('wk_transaccion t', 't.transaccionId = td.transaccionId')
        ->where('t.transaccionId', $transaccionId )->first();

        if ($tActDetalle) {
            if ($transaccionActividadId == $transaccionActId['transaccionActId']) {
                $model = new ContactoModel();
                $anio = date('Y');

                $contactoC = $model->asArray()->select('c.contacto')->from('wk_contacto c')
                ->where('c.tipoContactoId','1')->where('c.personaId', $encargado)->first();

                $msm ='
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
                                Ha iniciado el proceso: '.$nombreProceso.' a su cargo.
                            </p><br><br>
                            <p style="margin:2px;font-size:15px"></p><p style="margin:2px;font-size:15px;font-weight:bold;display:inline">
                            </p>La primera actividad del proceso: " '.$actividad.' " a cargo de '.$persona.' '.$apellido.' ha iniciado.</p>
                            <div style="width:100%;text-align:center;margin-top:10%">
                                <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                            </div>
                            <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - '.$anio.'</p>
                        </div>
                        </td>
                    </tr>
                </tbody>
                ';

                $email = \Config\Services::email();
                $email->setFrom('correspondencia.ucad@gmail.com', 'Proceso Iniciado: '.$nombreProceso);
                $email->setTo($contactoC['contacto']);
                $email->setSubject('Proceso Iniciado');
                $email->setMessage($msm);
                if ($email->send()) {
                    $mensaje = 12;
                }
            }
        }else{
            $mensaje = 12;
        }
        
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