<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\RolModMenuModel;
use App\Models\modAdministracion\MenuSubmenuModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function rolModMenu()
    {
        $rolModMenu = new RolModMenuModel();

        $datos = $rolModMenu->getRolMM();

        $data = [
            "datos" =>$datos
        ];

        return view('modAdministracion/rolModMenu',$data);
    }

    //Funcion para MOSTRAR DATOS DE LA TABLA MODULO MENU
    /*public function listarModMenu()
    {
        $modMenu = new RolModMenuModel();
        $datos = $modMenu->getModMenu();

        $dato = [
            "datos"     => $datos
        ];

        return view('modAdministracion/editRolMM', $dato);
    }*/

    //FUNCION PARA TRAER EL NOMBRE DEL ROL
    public function obtenerId($rolModuloMenuId)
    {
        $data = ["rolModuloMenuId" => $rolModuloMenuId];
        $rolModMenu = new RolModMenuModel();
        $respuesta = $rolModMenu->obtenerId($data);//fun editar

        $datos = [
            "datos" =>$respuesta
        ];

        return view('modAdministracion/editRolMM', $datos);
    }

    //Funcion para EDITAR
    public function actualizarRolMM()
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
