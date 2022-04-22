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
        $submenu = $MenuSubmenu->listarSubMenu();
        $total = $MenuSubmenu->mostrarTotal();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "submenu"     => $submenu,
            "total"     => $total,
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
}