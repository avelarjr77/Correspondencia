<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\MenuSubmenuModel;
use App\Models\modAdministracion\SubmenuModel;

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

    public function eliminar($nombreMenu)
    {
        $menu = new MenuSubmenuModel();

        $data = ["menuId" => $nombreMenu];

        $respuesta = $menu->eliminar($data);

        if ($respuesta) {
            return redirect()->to(base_url().'/menu_submenu')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url().'/menu_submenu')->with('mensaje', '5');
        }
    }

    //Funcion para EDITAR
    public function actualizar()
    {
        $datos = [
            "nombreMenu" => $_POST['nombreMenu']
        ];

        $menuId = $_POST['menuId'];

        $menu = new MenuSubmenuModel();

        $respuesta = $menu->actualizar($datos, $menuId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '3');
        }
    }

    //funcion para obtener el nombre del menu

    public function editar($menuId)
    {
        $menu = new MenuSubmenuModel();

        $data = ["menuId" => $menuId];
        $respuesta = $menu->editar($data);

        $datos = ["datos" => $respuesta];

        return view('modAdministracion/editMenu', $datos);
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