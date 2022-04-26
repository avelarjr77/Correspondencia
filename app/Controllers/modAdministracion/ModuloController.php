<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloModel;

class ModuloController extends BaseController{

    //LISTAR MODULOS
    public function adminModulo(){

        $Modulo = new ModuloModel();
        $datos = $Modulo->listarModulo();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modAdministracion/adminModulo', $data);
        }
    //CREAR MODULOS
    public function crearModulo(){

        $datos = [
            "nombre" => $_POST['nombre']
        ];

        $Modulo = new ModuloModel();
        $respuesta = $Modulo->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','1');
        } 
    } 

    //ELIMINAR MODULOS
    public function eliminar(){

        $moduloId = $_POST['moduloId'];

        $Modulo = new ModuloModel();
        $data = ["moduloId" => $moduloId];

        $respuesta = $Modulo->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','3');
        }
    }

    
    //Funcion para EDITAR
    /*public function obtenerModulo($nombres)
    {
        $data = [ "moduloId" => $nombres];

        $nombreModulo = new ModuloModel();
        $respuesta = $nombreModulo->obtenerModulo($data);

        $datos = ["datos" => $respuesta];

        return view('modAdministracion/actualizarModulo', $datos);
    }*/

    public function actualizarModulo()
    {
        $datos = [
            "nombre" => $_POST['nombre']
        ];

        $moduloId = $_POST['moduloId'];

        $nombreModulo = new ModuloModel();
        $respuesta = $nombreModulo->actualizarModulo($datos, $moduloId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '5');
        }
    }
    
    
}

?>