<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\CargoModel;

class CargoController extends BaseController{

    //LISTAR ROLES

    public function index(){

        $nombreCargo = new CargoModel();
        $datos = $nombreCargo->listarCargo();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('template/header', $data);
    }





    
}

?>