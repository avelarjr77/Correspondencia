<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\DepartamentoModel;

class DepartamentoController extends BaseController{

    //LISTAR ROLES

    public function departamento(){

        $nombreDepartamento = new DepartamentoModel();
        $datos = $nombreDepartamento->listarDepartamento();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/departamento', $data);
        }

    //CREAR ROLES
    public function crear(){

        $departamento = new DepartamentoModel();

        if($this->validate('validarDepart')){
            $departamento->insertar(
                [
                    "departamento"        => $_POST['departamento']
                ]
            );

            return redirect()->to(base_url(). '/departamento')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/departamento')->with('mensaje','1');
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $departamentoId = $_POST['departamentoId'];

        $departamento = new DepartamentoModel();
        $data = ["departamentoId" => $departamentoId];

        $respuesta = $departamento->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/departamento')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/departamento')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $departamento = new DepartamentoModel();
        if ($this->validate([
            'departamento'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_departamento.departamento]'
            ])) {
                $datos = [
                    "departamento"        => $_POST['departamento']
                ];

            $departamentoId = $_POST['departamentoId'];
            $respuesta = $departamento->actualizar($datos, $departamentoId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/departamento')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/departamento')->with('mensaje', '5');
        }         
    }
    
}

?>