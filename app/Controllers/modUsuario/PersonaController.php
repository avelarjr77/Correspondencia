<?php

namespace App\Controllers\modUsuario;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Controllers\modUsuario\isDUI;
use App\Models\modProceso\ActividadModel;
use App\Models\modUsuario\PersonaModel;
use App\Models\modUsuario\UsuarioModel;

//FUNCION VALIDAR DUI
function isDUI($dui) {

    $dui = $_POST['dui'];

    if ((bool)preg_match('/(^\d{8})-(\d$)/', $dui) === true) {
            [$digits, $digit_veri] = explode('-', $dui);
            $sum = 0;

            for ($i = 0, $l = strlen($digits); $i < $l; $i++) {
                $sum += (9 - $i) * (int)$digits[$i];
            }
            
        return (int)$digit_veri === (10 - ($sum % 10)) % 10;
    }  return false;        
}

class PersonaController extends BaseController
{

    //LISTAR PERSONA

    public function persona()
    {

        $nombrePersona  = new PersonaModel();
        $nombreUsuario  = new UsuarioModel();
        $usuario        = $nombreUsuario->listarUsuario();
        $datos          = $nombrePersona->listarPersona();
        $cargo          = $nombrePersona->listarCargo();
        $departamento   = $nombrePersona->listarDepartamento();
        $rol            = $nombreUsuario->listarRol();

        $mensaje = session('mensaje');

        $data = [
            "datos"         => $datos,
            "usuario"       => $usuario,
            "cargo"         => $cargo,
            "departamento"  => $departamento,
            "rol"           => $rol,
            "mensaje"       => $mensaje
        ];

        return view('modUsuario/persona', $data);
    }

    //CREAR PERSONA
    public function crear()
    {
        if($this->validate('validarDUI')){
            if (isDui($_POST['dui']) == true) {
                $hora=new Time('now');
                $session = session('usuario');
    
                $datosPersona = [
                    "dui" => $_POST['dui'],
                    "nombres" => $_POST['nombres'],
                    "primerApellido" => $_POST['primerApellido'],
                    "segundoApellido" => $_POST['segundoApellido'],
                    "fechaNacimiento" => $_POST['fechaNacimiento'],
                    "genero" => $_POST['genero'],
                    "cargoId" => $_POST['cargoId'],
                    "departamentoId" => $_POST['departamentoId'],
                    "usuarioCrea"   => $session,
                    "fechaCrea"     => $hora,
                ];
    
                $persona = new PersonaModel();
                $respuesta = $persona->insertar($datosPersona);
    
                if ($respuesta > 0) {
                    return redirect()->to(base_url() . '/persona')->with('mensaje', '0');
                }
            }
        }
        return redirect()->to(base_url() . '/persona')->with('mensaje', '7');
    }

    //ELIMINAR PERSONA
    public function eliminar()
    {

        $personaId      = $_POST['personaId'];

        $persona        = new PersonaModel();
        $activividad    = new ActividadModel();
        $data           = ["personaId" => $personaId];

        //Para buscar si la Persona está relacionado con otros datos
        $buscarRelacion = $activividad->select('personaId')->where('personaId', $personaId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/persona')->with('mensaje', '6');
        }

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
            'nombres'           => 'alpha_space',
            'primerApellido'    => 'alpha',
            'segundoApellido'   => 'alpha'
        ])) {

            $hora=new Time('now');
            $session = session('usuario');

            $datos = [
                "nombres"           => $_POST['nombres'],
                "primerApellido"    => $_POST['primerApellido'],
                "segundoApellido"   => $_POST['segundoApellido'],
                "fechaNacimiento"   => $_POST['fechaNacimiento'],
                "genero"            => $_POST['genero'],
                "cargoId"           => $_POST['cargoId'],
                "departamentoId"    => $_POST['departamentoId'],
                "usuarioModifica"   => $session,
                "fechaModifica"     => $hora,
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
