<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\RolModMenuModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function rolModMenu()
    {
        $rolModMenu = new RolModMenuModel();

       //$data = $this->input->post();
        //$moduloId = $_POST['mod'];
        //$mod['modulo']   = "moduloId";

        $moduloId = $this->request->getVar('mod');
        //var_dump($moduloId);
        //$moduloId = $data['mod'];

        $datos = $rolModMenu->getRolMM();
        $modMenu = $rolModMenu->getModMenu();

        $dato = [
            "datos" =>$datos,
            "modMenu" =>$modMenu
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
