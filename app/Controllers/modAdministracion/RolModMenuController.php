<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\RolModMenuModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $rolModMenu = new RolModMenuModel();

        $datos = $rolModMenu->getRolMM();
        //$modMenu = $rolModMenu->getModMenu($moduloId);

        $dato = [
            "datos" => $datos
        ];

        return view('modAdministracion/rolModMenu',$dato);
    }

    public function modulo()
    {
        $rolMM = new RolModMenuModel();

       
        $moduloId = $this->request->getVar('moduloId');
        //print_r($moduloId);

        $modMenu = $rolMM->getModMenu($moduloId);

        $id ="id";

        $data = [
            "list" => $modMenu
        ];
        
        echo json_encode($data);
        
    }

}
