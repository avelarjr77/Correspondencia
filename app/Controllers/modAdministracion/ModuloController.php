<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloModel;

class ModuloController extends BaseController
{


    //LISTAR MODULOS
    public function adminModulo()
    {

        $Modulo = new ModuloModel();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $Modulo->asObject()->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/adminModulo', $data);
    }
    //CREAR MODULOS
    public function crearModulo()
    {

        $Modulo = new ModuloModel();

        if ($this->validate('validarModuloMenu')) {
            $Modulo->insertar(
                [
                    "nombre"        => $_POST['nombre'],
                ]
            );

            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '0');
        }

        return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '1');
    }

    //ELIMINAR MODULOS
    public function eliminar()
    {

        $moduloId = $_POST['moduloId'];

        $Modulo = new ModuloModel();
        $data = ["moduloId" => $moduloId];

        $respuesta = $Modulo->eliminar($data);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '3');
        }
    }

    public function actualizarModulo()
    {
        $nombreModulo = new ModuloModel();
        if ($this->validate([
            'nombre'        => 'min_length[3]|max_length[45]|alpha|is_unique[co_modulo.nombre]',
        ])) {
            $datos = [
                "nombre"        => $_POST['nombre'],
            ];

            $moduloId = $_POST['moduloId'];


            $respuesta = $nombreModulo->actualizarModulo($datos, $moduloId);

            $datos = ["datos" => $respuesta];

            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '5');
        }
    }
}
