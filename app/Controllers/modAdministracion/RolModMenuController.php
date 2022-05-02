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
        $dato = [
            "datos" => $datos
        ];

        return view('modAdministracion/rolModMenu', $dato);
    }

    public function modulo()
    {
        $rolMM = new RolModMenuModel();

        $moduloId = $this->request->getVar('moduloId');

        $modMenu = $rolMM->getModMenu($moduloId);

        $id = "id";

        $data = [
            "list" => $modMenu,
            "moduloId" => $moduloId,
            "id" => $id
        ];

        echo json_encode($data);
    }
}
