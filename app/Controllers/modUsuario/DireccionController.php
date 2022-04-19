<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\DireccionModel;

class DireccionController extends BaseController{

    //LISTAR DIRECCION

    public function direccion(){

        $direccion = new DireccionModel();
        $datos = $direccion->listarDireccion();
        $persona = $direccion->listarPersona();
        $municipio = $direccion->listarMunicipio();
        

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "persona" => $persona,
            "municipio" => $municipio,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/direccion', $data);
        }

    //CREAR DIRECCION
    public function crearDireccion(){

        $datos = [
            "personaId" => $_POST['personaId'],
            "tipoDireccion" => $_POST['tipoDireccion'],
            "nombreDireccion" => $_POST['nombreDireccion'],
            "municipioId" => $_POST['municipioId']
        ];

        $direccion = new DireccionModel();
        $respuesta = $direccion->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/direccion')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/direccion')->with('mensaje','1');
        } 
    } 

    //ELIMINAR DIRECCION
    public function eliminarDireccion(){

        $direccionId = $_POST['direccionId'];

        $direccion = new DireccionModel();
        $data = ["direccionId" => $direccionId];

        $respuesta = $direccion->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/direccion')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/direccion')->with('mensaje','3');
        }
    }

    //ACTUALIZAR DIRECCION
    public function actualizarDireccion()
    {
        $datos = [
            "direccion" => $_POST['direccion']
        ];

        $direccionId = $_POST['direccionId'];

        $direccion = new DireccionModel();
        $respuesta = $direccion->actualizar($datos, $direccionId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/direccion')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/direccion')->with('mensaje', '5');
        }
    }
    
}

?>