<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\DireccionModel;

class DireccionController extends BaseController{

    //LISTAR DIRECCION

    public function direccion(){

        $direccion = new DireccionModel();
        $datos = $direccion->listarDireccion();
        $persona = $direccion->listarPersona();
        $departamento = $direccion->listarDepartamento();
        $municipio = $direccion->listarMunicipioA();
        

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "persona" => $persona,
            "municipioA" => $municipio,
            "departamento" => $departamento,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/direccion', $data);
    }

    public function municipio(){

        $mun = new DireccionModel();
        
        $deptoId = $this->request->getVar('deptoId');

        $respuesta = $mun->listarMunicipio($deptoId);

        echo json_encode($respuesta);
    }

    public function municipioA(){

        $mun = new DireccionModel();
        
        $deptoId = $this->request->getVar('deptoId');

        $respuesta = $mun->listarMunicipioAC($deptoId);

        echo json_encode($respuesta);
    }

    public function odepto(){

        $mun = new DireccionModel();
        
        $municipioId = $this->request->getVar('municipioId');

        $respuesta = $mun->listarDepto($municipioId);

        echo json_encode($respuesta);
    }

    public function deptoList(){

        $mun = new DireccionModel();
        
        //$deptoId = $this->request->getVar('deptoId');

        $respuesta = $mun->listarDepartamento();

        echo json_encode($respuesta);
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
            "personaId" => $_POST['personaId'],
            "tipoDireccion" => $_POST['tipoDireccion'],
            "nombreDireccion" => $_POST['nombreDireccion'],
            "municipioId" => $_POST['municipioId']
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