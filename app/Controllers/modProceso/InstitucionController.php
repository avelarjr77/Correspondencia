<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\InstitucionModel;

class InstitucionController extends BaseController{

    //LISTAR INSTITUCION

    public function institucion(){

        $nombreInstitucion = new InstitucionModel();
        $datos = $nombreInstitucion->listarInstitucion();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modProceso/institucion', $data);
    }

    //CREAR INSTITUCION
    public function crear(){

        $datos = [
            "nombreInstitucion" => $_POST['nombreInstitucion']
        ];

        $nombreInstitucion = new InstitucionModel();
        $respuesta = $nombreInstitucion->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/institucion')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/institucion')->with('mensaje','1');
        } 
    } 

    //ELIMINAR INSTITUCION
    public function eliminar(){

        $institucionId = $_POST['institucionId'];

        $nombreInstitucion = new InstitucionModel();
        $data = ["institucionId" => $institucionId];

        $respuesta = $nombreInstitucion->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/institucion')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/institucion')->with('mensaje','3');
        }
    }

    //EDITAR INSTITUCION
    public function actualizar()
    {
        $datos = [
            "nombreInstitucion" => $_POST['nombreInstitucion']
        ];

        $institucionId = $_POST['institucionId'];

        $nombreInstitucion = new InstitucionModel();
        $respuesta = $nombreInstitucion->actualizar($datos, $institucionId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/institucion')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/institucion')->with('mensaje', '5');
        }
    }
    
}

?>