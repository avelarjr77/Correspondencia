<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\PersonaModel;

class PersonaController extends BaseController{

    //LISTAR ROLES

    public function persona(){

        $nombrePersona = new PersonaModel();
        $datos = $nombrePersona->listarPersona();
        $cargo = $nombrePersona->listarCargo();
        $departamento = $nombrePersona->listarDepartamento();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "cargo" => $cargo,
            "departamento" => $departamento,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/persona', $data);
        }

    //CREAR ROLES
    public function crear(){

        $datos = [
            "nombres" => $_POST['nombres'],
            "primerApellido" => $_POST['primerApellido'],
            "segundoApellido" => $_POST['segundoApellido'],
            "fechaNacimiento" => $_POST['fechaNacimiento'],
            "genero" => $_POST['genero'],
            "cargoId" => $_POST['cargoId'],
            "departamentoId" => $_POST['departamentoId']
        ];

        $persona = new PersonaModel();
        $respuesta = $persona->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/persona')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/persona')->with('mensaje','1');
        } 
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $personaId = $_POST['personaId'];

        $persona = new PersonaModel();
        $data = ["personaId" => $personaId];

        $respuesta = $persona->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/persona')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/persona')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $datos = [
            "persona" => $_POST['persona']
        ];

        $personaId = $_POST['personaId'];

        $persona = new PersonaModel();
        $respuesta = $persona->actualizar($datos, $personaId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '5');
        }
    }
    
}

?>