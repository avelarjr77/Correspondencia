<?php

namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\PersonaModel;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\TipoContactoModel;

class PersonaController extends BaseController
{

    //LISTAR PERSONA

    public function persona()
    {

        $nombrePersona = new PersonaModel();
        $nombreUsuario = new UsuarioModel();
        $usuario = $nombreUsuario->listarUsuario();
        $datos = $nombrePersona->listarPersona();
        $cargo = $nombrePersona->listarCargo();
        $departamento = $nombrePersona->listarDepartamento();
        $rol = $nombreUsuario->listarRol();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "usuario" => $usuario,
            "cargo" => $cargo,
            "departamento" => $departamento,
            "rol" => $rol,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/persona', $data);
    }

    //CREAR PERSONA
    public function crear()
    {

        $datosPersona = [
            "dui" => $_POST['dui'],
            "nombres" => $_POST['nombres'],
            "primerApellido" => $_POST['primerApellido'],
            "segundoApellido" => $_POST['segundoApellido'],
            "fechaNacimiento" => $_POST['fechaNacimiento'],
            "genero" => $_POST['genero'],
            "cargoId" => $_POST['cargoId'],
            "departamentoId" => $_POST['departamentoId']
        ];

        $persona = new PersonaModel();
        $respuesta = $persona->insertar($datosPersona);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '0');
        } else {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '1');
        }
    }

    //ELIMINAR PERSONA
    public function eliminar()
    {

        $personaId = $_POST['personaId'];

        $persona = new PersonaModel();
        $data = ["personaId" => $personaId];

        $respuesta = $persona->eliminar($data);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '3');
        }
    }

    //ACTUALIZAR PERSONA
    public function actualizar()
    {

        $persona = new PersonaModel();
        if ($this->validate([
            'nombres'        => 'alpha_space',
            'primerApellido'        => 'alpha',
            'segundoApellido'        => 'alpha'
        ])) {
            $datos = [
                "nombres" => $_POST['nombres'],
                "primerApellido" => $_POST['primerApellido'],
                "segundoApellido" => $_POST['segundoApellido'],
                "fechaNacimiento" => $_POST['fechaNacimiento'],
                "genero" => $_POST['genero'],
                "cargoId" => $_POST['cargoId'],
                "departamentoId" => $_POST['departamentoId']
            ];
            $personaId = $_POST['personaId'];


            $respuesta = $persona->actualizar($datos, $personaId);

            $datos = ["datos" => $respuesta];

            return redirect()->to(base_url() . '/persona')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '5');
        }
    }
}
