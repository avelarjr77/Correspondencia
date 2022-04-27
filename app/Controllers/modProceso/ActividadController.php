<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\ActividadModel;

class ActividadController extends BaseController{

    //LISTAR PROCESO

    public function actividad(){

        $nombreActividad = new ActividadModel();
        $datos = $nombreActividad->listarActividad();
        $etapa = $nombreActividad->listarEtapa();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "etapa" => $etapa,
            "mensaje" => $mensaje
        ];

        return view('modProceso/actividad', $data);
        }

    //CREAR PROCESO
    public function crear(){

        $datos = [
            "nombreActividad" => $_POST['nombreActividad'],
            "descripcion" => $_POST['descripcion'],
            "etapaId" => $_POST['etapaId']
        ];

        $actividad = new ActividadModel();
        $respuesta = $actividad->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/actividad')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/actividad')->with('mensaje','1');
        } 
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $actividadId = $_POST['actividadId'];

        $actividad = new ActividadModel();
        $data = ["actividadId" => $actividadId];

        $respuesta = $actividad->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/actividad')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/actividad')->with('mensaje','3');
        }
    }

    //ELIMINAR PROCESO
    public function actualizar()
    {
        $datos = [
            "nombreActividad" => $_POST['nombreActividad'],
            "descripcion" => $_POST['descripcion'],
            "etapaId" => $_POST['etapaId']
        ];

        $actividadId = $_POST['actividadId'];

        $actividad = new ActividadModel();
        $respuesta = $actividad->actualizar($datos, $actividadId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/actividad')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/actividad')->with('mensaje', '5');
        }
    }
    
}

?>