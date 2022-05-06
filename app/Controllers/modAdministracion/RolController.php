<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;

class RolController extends BaseController{

    //LISTAR ROLES

    public function adminRol(){

        $nombreRol = new RolModel();
        $datos = $nombreRol->listarRol();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modAdministracion/adminRol', $data);
        }

    //CREAR ROLES
    public function crear(){

        $datos = [
            "nombreRol" => $_POST['nombreRol']
        ];

        $nombreRol = new RolModel();
        $respuesta = $nombreRol->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/adminRol')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/adminRol')->with('mensaje','1');
        } 
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $rolId = $_POST['rolId'];

        $nombreRol = new RolModel();
        $data = ["rolId" => $rolId];

        $respuesta = $nombreRol->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/adminRol')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/adminRol')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $datos = [
            "nombreRol" => $_POST['nombreRol']
        ];

        $rolId = $_POST['rolId'];

        $nombreRol = new RolModel();
        $respuesta = $nombreRol->actualizar($datos, $rolId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/adminRol')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/adminRol')->with('mensaje', '5');
        }
    }
    
}

?>