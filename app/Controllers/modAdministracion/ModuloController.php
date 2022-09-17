<?php

namespace App\Controllers\modAdministracion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloMenuModel;
use App\Models\modAdministracion\ModuloModel;
use App\Models\modAdministracion\MovimientosModel;

class ModuloController extends BaseController
{
    public function __construct(){
		helper(['system_helper']);
	}

    //LISTAR MODULOS
    public function adminModulo()
    {

        $Modulo = new ModuloModel();
        helper(['form']);

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $Modulo->asObject()->findAll(),
            "mensaje"   => $mensaje,
            "prueba" => fraseAleatoria()
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

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL MODULO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó módulo',
                'descripcion'   => $_POST['nombre'],
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '0');
        }

        return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '1');
    }

    //ELIMINAR MODULOS
    public function eliminar()
    {

        $moduloId = $_POST['moduloId'];

        $Modulo = new ModuloModel();
        $moduloMenu = new ModuloMenuModel();
        $data = ["moduloId" => $moduloId];

        $nombreModulo = $Modulo->asArray()->select("nombre")
        ->where("moduloId", $moduloId)->first();

        //Para buscar si el Módulo está relacionado con un Modulo-menu
        $buscarRelacion = $moduloMenu->select('moduloId')->where('moduloId', $moduloId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '7');
        }

        $respuesta = $Modulo->eliminar($data);

        if ($respuesta > 0) {

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO EL MODULO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó módulo',
                'descripcion'   => $nombreModulo,
                'hora'          => $hora,
            ]);
            //END

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

            //PARA REGISTRAR EN BITACORA QUIEN EDITO EL MODULO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Editó módulo',
                'descripcion'   => $_POST['nombre'],
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '5');
        }
    }
}
