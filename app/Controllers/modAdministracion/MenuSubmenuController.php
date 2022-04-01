<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\MenuSubmenuModel;
use App\Models\SubmenuModel;

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

    //Funcion para EDITAR
    public function editar()
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

    //Funcion para OBTENER NOMBRE
    public function obtenerNombre($menuId)
    {

        $data = ["menuId" => $menuId];
        $MenuSubmenu = new MenuSubmenuModel();
        $respuesta = $MenuSubmenu->obtenerNombre($data);

        $datos = ["datos" => $respuesta];

        return view('crear', $datos);
    }

    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function listarSubmenu()
    {
        $submenu = new SubmenuModel();
        var_dump($submenu->asObject()->findAll());
    }

    //Funcion para MOSTRAR DATOS DE LA TABLA SUBMENU
    public function nombreSubMenu()
    {
        $nombreSubMenu = new SubmenuModel();
        /*$dataHeader =[
            'title' => 'Submenus'
        ];*/

        $data = [
            'nombreSubMenu'   => $nombreSubMenu->asObject()->findAll()
        ];

        return view('modAdministracion/menu_submenu', $data);
    }
}
