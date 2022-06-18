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

    //CREAR CARGO
    public function crear(){

        $cargo = new CargoModel();

        if($this->validate('validarCargo')){
            $cargo->insertar(
                [
                    "cargo"        => $_POST['cargo']
                ]
            );

            return redirect()->to(base_url(). '/cargo')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/cargo')->with('mensaje','1');

    } 

    //ELIMINAR CARGO
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
        $cargo = new CargoModel();
        if ($this->validate([
            'cargo'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_cargo.cargo]'
            ])) {
                $datos = [
                    "cargo"        => $_POST['cargo']
                ];

            $cargoId = $_POST['cargoId'];
            
            $respuesta = $cargo->actualizar($datos, $cargoId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/cargo')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/cargo')->with('mensaje', '5');
        } 
    }
    
}

?>