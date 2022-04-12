<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\CargoModel;

class CargoController extends BaseController{

    //LISTAR ROLES

    public function cargo(){

        $nombreCargo = new CargoModel();
        $datos = $nombreCargo->listarCargo();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/cargo', $data);
        }

    //CREAR ROLES
    public function crear(){

        $datos = [
            "cargo" => $_POST['cargo']
        ];

        $cargo = new CargoModel();
        $respuesta = $cargo->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/cargo')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/cargo')->with('mensaje','1');
        } 
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $cargoId = $_POST['cargoId'];

        $cargo = new CargoModel();
        $data = ["cargoId" => $cargoId];

        $respuesta = $cargo->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/cargo')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/cargo')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $datos = [
            "cargo" => $_POST['cargo']
        ];

        $cargoId = $_POST['cargoId'];

        $cargo = new CargoModel();
        $respuesta = $cargo->actualizar($datos, $cargoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/cargo')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/cargo')->with('mensaje', '5');
        }
    }
    
}

?>