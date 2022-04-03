<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\MenuSubmenuModel;

class MenuSubmenuController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function menu_submenu()
    {
        $MenuSubmenu = new MenuSubmenuModel();
        $datos = $MenuSubmenu->listarMenu();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/menu_submenu', $data);
    }

    //Funcion para INSERTAR
    public function crear()
    {
        $datos = [
            "nombreMenu"    => $_POST['nombreMenu']
        ];
        $nombreMenu = new MenuSubmenuModel();
        $respuesta = $nombreMenu->insertar($datos);
        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '0');
        }
    }

    public function eliminar($menuId)
    {
        $data = ["menuId" => $menuId];
        $nombreMenu = new MenuSubmenuModel();
        $respuesta = $nombreMenu->eliminar($data);
        if ($respuesta) {
            return redirect()->to(base_url() . '/')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '/')->with('mensaje', '0');
        }
    }

    //Funcion para EDITAR
    public function editar()
    {
        /* $datos = [
            "nombreMenu"    => $_POST['nombreMenu']
        ];
        $nombreMenu = new MenuSubmenuModel();
        $respuesta = $nombreMenu->insertar($datos);
        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '0');
        }*/
    }

    //Funcion para OBTENER NOMBRE
    public function obtenerNombre($menuId)
    {

        $data = ["menuId" => $menuId];
        $MenuSubmenu = new MenuSubmenuModel();
        $respuesta = $MenuSubmenu->obtenerNombre($data);

        $datos = ["datos" => $respuesta];

        return view('modAdministracion/menu_submenu', $datos);
    }

    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function listarSubmenu()
    {
        $submenu = new MenuSubmenuModel();
        var_dump($submenu->asObject()->findAll());
    }

    //Funcion para MOSTRAR DATOS DE LA TABLA SUBMENU
    public function nombreSubMenu()
    {
        $Submenu = new MenuSubmenuModel();
        $datos = $Submenu->listarSubMenu();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/menu_submenu', $data);
    }

    //Funcion para INSERTAR
    public function crearSubmenu()
    {
        $datos = [
            "nombreSubMenu"     => $_POST['nombreSubMenu'],
            "menuId"            => $_POST['menuId']
        ];
        $crearSubmenu = new MenuSubmenuModel();
        $respuesta = $crearSubmenu->crearSubmenu($datos);
        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '0');
        }
    }
}
