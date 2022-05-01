<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\SubmenuModel;

class SubMenuController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function submenus()
    {
        $submenu = new SubmenuModel();
        
        $datos = $submenu->listarMenu();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "submenu"     => $submenu->select()->asObject()->join('co_menu','co_menu.menuId = co_submenu.menuId')->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/submenus', $data);
    }

    //Funcion para INSERTAR
    public function agregarSubMenu()
    {
        $datos = [
            "nombreSubMenu"     => $_POST['nombreSubMenu'],
            "menuId"            => $_POST['menuId'],
            "nombreArchivo"     => $_POST['nombreArchivo']
        ];

        $submenu = new SubmenuModel();
        $respuesta = $submenu->crearSubmenu($datos);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/submenus')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '/submenus')->with('mensaje', '0');
        }
    }
    //Funcion para EDITAR
    public function actualizarSubmenu()
    {
        $datos = [
            "nombreSubMenu"     => $_POST['nombreSubMenu'],
            "menuId"            => $_POST['menuId'],
            "nombreArchivo"     => $_POST['nombreArchivo']
        ];

        $subMenuId = $_POST['subMenuId'];

        $MenuSubmenu = new SubmenuModel();

        $respuesta = $MenuSubmenu->actualizarSubmenu($datos, $subMenuId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/submenus')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/submenus')->with('mensaje', '3');
        }
    }

    public function eliminarSubMenu($subMenuId)
    {
        $MenuSubmenu = new SubmenuModel();

        $data = ["subMenuId" => $subMenuId];

        $respuesta = $MenuSubmenu->eliminar($data);

        if ($respuesta) {
            return redirect()->to(base_url().'/submenus')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url().'/submenus')->with('mensaje', '5');
        }
    }
}