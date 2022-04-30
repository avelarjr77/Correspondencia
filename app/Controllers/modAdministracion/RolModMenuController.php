<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\ModuloModel;
use App\Models\modAdministracion\RolModMenuModel;
use App\Models\modAdministracion\MenuSubmenuModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function rolModMenu()
    {
        $rolModMenu = new RolModMenuModel();
        $Modulo = new ModuloModel();
        $menu = new MenuSubmenuModel();
       

        $moduloId = $this->request->getVar('mod');
        //var_dump($moduloId);
        //$moduloId = $data['mod'];

        $datos = $rolModMenu->getRolMM();
        $modMenu = $rolModMenu->getModMenu();

        $dato = [
            "datos" =>$datos,
            "modMenu" =>$modMenu,
            "Modulo" => $Modulo->asObject()->findAll(),
            "menu" => $menu->asObject()->findAll()
        ];

        return view('modAdministracion/rolModMenu',$dato);
    }



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

}
