<?php

namespace App\Controllers\modAdministracion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloModel;
use App\Models\modAdministracion\ModuloMenuModel;
use App\Models\modAdministracion\MenuSubMenuModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modAdministracion\RolModMenuModel;

class ModuloMenuController extends BaseController
{


    //LISTAR MODULOS MENUS
    public function moduloMenu()
    {

        $ModuloMenu = new ModuloMenuModel();

        $mensaje = session('mensaje');

        $data = [
            "ModuloM"   => $ModuloMenu->listarModuloMenu(),
            "menu"      => $ModuloMenu->listarMenu(),
            "modulo"    => $ModuloMenu->listarModulo(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/moduloMenu', $data);
    }

    //CREAR MODULOS MENUS
    public function crearModuloMenu()
    {


        $datos = [
            "moduloId"  => $_POST['moduloId'],
            "menuId"    => $_POST['menuId']
        ];

        $ModuloMenu = new ModuloMenuModel();
        $respuesta  = $ModuloMenu->insertar($datos);

        $moduloId   = $_POST['moduloId'];
        $menuId     = $_POST['menuId'];

        $nombreModulo = $ModuloMenu->asArray()->select("m.nombre")
            ->from('co_modulo_menu mm')
            ->join("co_modulo m", 'm.moduloId = mm.moduloId')
            ->where("mm.moduloId", $moduloId)
            ->first();

        $nombreMenu = $ModuloMenu->asArray()->select("m.nombreMenu")
            ->from('co_modulo_menu mm')
            ->join("co_menu m", 'm.menuId = mm.menuId')
            ->where("mm.menuId", $menuId)
            ->first();


        //PARA REGISTRAR EN BITACORA QUIEN CREO EL MODULO-MENÚ
        $this->bitacora  = new MovimientosModel();
        $hora = new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó Módulo-Menú',
            'descripcion'   => $nombreModulo['nombre'] . '/' . $nombreMenu['nombreMenu'],
            'hora'          => $hora,
        ]);
        //END

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '0');
        } else {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '1');
        }
    }

    //ELIMINAR MODULOS
    public function eliminar()
    {

        $moduloMenuId   = $_POST['moduloMenuId'];

        $ModuloMenu     = new ModuloMenuModel();
        $RolModuloMenu  = new RolModMenuModel();
        $data = ["moduloMenuId" => $moduloMenuId];

        $nombreModulo = $ModuloMenu->asArray()->select("m.nombre")
            ->from('co_modulo_menu mm')
            ->join("co_modulo m", 'm.moduloId = mm.moduloId')
            ->where("mm.moduloMenuId", $moduloMenuId)
            ->first();

        $nombreMenu = $ModuloMenu->asArray()->select("m.nombreMenu")
            ->from('co_modulo_menu mm')
            ->join("co_menu m", 'm.menuId = mm.menuId')
            ->where("mm.moduloMenuId", $moduloMenuId)
            ->first();

        //Para buscar si el Módulo/Menú está relacionado con una dependencia
        $buscarRelacion = $RolModuloMenu->select('moduloMenuId')->where('moduloMenuId', $moduloMenuId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '6');
        }

        $respuesta = $ModuloMenu->eliminar($data);

        if ($respuesta > 0) {
            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO EL MODULO-MENÚ
            $this->bitacora  = new MovimientosModel();
            $hora       = new Time('now');
            $session    = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó Módulo-Menú',
                'descripcion'   => $nombreModulo['nombre'] . '/' . $nombreMenu['nombreMenu'],
                'hora'          => $hora,
            ]);
            //END
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '3');
        }
    }

    public function actualizar()
    {
        $datos = [
            "moduloId"  => $_POST['moduloId'],
            "menuId"    => $_POST['menuId']
        ];

        $moduloMenuId   = $_POST['moduloMenuId'];

        $ModuloMenu     = new ModuloMenuModel();
        $respuesta      = $ModuloMenu->actualizar($datos, $moduloMenuId);

        $nombreModulo   = $ModuloMenu->asArray()->select("m.nombre")
            ->from('co_modulo_menu mm')
            ->join("co_modulo m", 'm.moduloId = mm.moduloId')
            ->where("mm.moduloMenuId", $moduloMenuId)
            ->first();

        $nombreMenu = $ModuloMenu->asArray()->select("m.nombreMenu")
            ->from('co_modulo_menu mm')
            ->join("co_menu m", 'm.menuId = mm.menuId')
            ->where("mm.moduloMenuId", $moduloMenuId)
            ->first();

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUIEN CREO EL MODULO-MENÚ
        $this->bitacora  = new MovimientosModel();
        $hora = new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó Módulo-Menú',
            'descripcion'   => $nombreModulo['nombre'] . '/' . $nombreMenu['nombreMenu'],
            'hora'          => $hora,
        ]);
        //END

        if ($respuesta) {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '5');
        }
    }
}
