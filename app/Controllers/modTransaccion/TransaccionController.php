<?php namespace App\Controllers\modTransaccion;

use App\Controllers\BaseController;
use App\Models\modTransaccion\TransaccionModel;

class TransaccionController extends BaseController{

    //LISTAR TRANSACCION

    public function index(){

        $nombre = new TransaccionModel();
        $datos = $nombre->getTransaccion();
        $proceso = $nombre->listarProceso();
        $persona = $nombre->listarPersona();
        $institucion = $nombre->listarInstitucion();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "proceso" => $proceso,
            "persona" => $persona,
            "institucion" => $institucion,
            "mensaje" => $mensaje
        ];

        return view('modTransaccion/transaccion', $data);
        }

    //CREAR TRANSACCION
    public function crear(){

        $datos = [
            "procesoId" => $_POST['procesoId'],
            "personaId" => $_POST['personaId'],
            "institucionId" => $_POST['institucionId'],
            "estadoTransaccion" => $_POST['estadoTransaccion'],
            "fechaInicio" => $_POST['fechaInicio'],
            "fechaFin" => $_POST['fechaFin'],
            "horaInicio" => $_POST['horaInicio'],
            "horaFin" => $_POST['horaFin'],
            "observaciones" => $_POST['observaciones']
        ];

        $transaccion = new TransaccionModel();
        $respuesta = $transaccion->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/transaccion')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/transaccion')->with('mensaje','1');
        } 
    } 

    //ELIMINAR TRANSACCION
    public function eliminar(){

        $transaccionId = $_POST['transaccionId'];

        $transaccion = new TransaccionModel();
        $data = ["transaccionId" => $transaccionId];

        $respuesta = $transaccion->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/transaccion')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/transaccion')->with('mensaje','3');
        }
    }

    //ACTUALIZAR TRANSACCION
    public function actualizar()
    {
        $datos = [
            "procesoId" => $_POST['procesoId'],
            "personaId" => $_POST['personaId'],
            "institucionId" => $_POST['institucionId'],
            "estadoTransaccion" => $_POST['estadoTransaccion'],
            "fechaInicio" => $_POST['fechaInicio'],
            "fechaFin" => $_POST['fechaFin'],
            "horaInicio" => $_POST['horaInicio'],
            "horaFin" => $_POST['horaFin'],
            "observaciones" => $_POST['observaciones']
        ];

        $transaccionId = $_POST['transaccionId'];

        $transaccion = new TransaccionModel();
        $respuesta = $transaccion->actualizar($datos, $transaccionId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/transaccion')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/transaccion')->with('mensaje', '5');
        }
    }
}

?>