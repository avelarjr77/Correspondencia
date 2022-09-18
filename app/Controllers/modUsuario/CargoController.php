<?php

namespace App\Controllers\modUsuario;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modUsuario\CargoModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modUsuario\PersonaModel;

class CargoController extends BaseController
{

    //LISTAR ROLES

    public function cargo()
    {

        $nombreCargo    = new CargoModel();
        $datos          = $nombreCargo->listarCargo();

        $mensaje        = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modUsuario/cargo', $data);
    }

    //CREAR CARGO
    public function crear()
    {

        $cargo = new CargoModel();

        if ($this->validate('validarCargo')) {
            $cargo->insertar(
                [
                    "cargo"        => $_POST['cargo']
                ]
            );

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL CARGO
            $this->bitacora  = new MovimientosModel();
            $hora = new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó cargo',
                'descripcion'   => $_POST['cargo'],
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/cargo')->with('mensaje', '0');

        }

            return redirect()->to(base_url() . '/cargo')->with('mensaje', '1');
    }

    //ELIMINAR CARGO
    public function eliminar()
    {

        $cargoId    = $_POST['cargoId'];

        $cargo      = new CargoModel();
        $persona    = new PersonaModel();
        $data       = ["cargoId" => $cargoId];

        $nombreCargo = $cargo->asArray()->select("cargo")
        ->where("cargoId", $cargoId)->first();

        //Para buscar si el Cargo está relacionado con una Persona
        $buscarRelacion = $persona->select('cargoId')->where('cargoId', $cargoId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/cargo')->with('mensaje', '7');
        }

        $respuesta = $cargo->eliminar($data);

        if ($respuesta > 0) {

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINÓ EL CARGO
            $this->bitacora  = new MovimientosModel();
            $hora = new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó cargo',
                'descripcion'   => $nombreCargo,
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/cargo')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/cargo')->with('mensaje', '3');
        }
    }

    public function actualizar()
    {
        $cargo = new CargoModel();
        if ($this->validate([
            'cargo'         => 'min_length[3]|max_length[45]|is_unique[wk_cargo.cargo]'
        ])) {

            $datos = [
                "cargo"     => $_POST['cargo']
            ];

            $cargoId    = $_POST['cargoId'];

            $respuesta  = $cargo->actualizar($datos, $cargoId);

            $datos      = ["datos" => $respuesta];

            //PARA REGISTRAR EN BITACORA QUIEN EDITÓ EL CARGO
            $this->bitacora  = new MovimientosModel();
            $hora = new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Editó cargo',
                'descripcion'   => $_POST['cargo'],
                'hora'          => $hora,
            ]);
            //END

            

            return redirect()->to(base_url() . '/cargo')->with('mensaje', '0');
        } else {
            return redirect()->to(base_url() . '/cargo')->with('mensaje', '1');
        }
    }
}