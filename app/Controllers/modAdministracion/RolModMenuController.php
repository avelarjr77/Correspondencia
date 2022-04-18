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
       /* $modulo = array
            'moduloId' => $this->request->getGet('moduloId')
        );*/
        //var_dump($modulo);
        //$moduloId = $data['mod'];
        
        //$moduloId = $this->request->getVar('moduloId');

        //var_dump($moduloId);

        $datos = $rolModMenu->getRolMM();
        $modMenu = $rolModMenu->getModMenu();

        $data = [
            "datos" =>$datos,
            "modMenu" =>$modMenu
        ];

        return view('modAdministracion/rolModMenu',$data);
    }

    public function getMenu()
    {
        $rolModMenu = new RolModMenuModel();
       /* $modulo = array
            'moduloId' => $this->request->getGet('moduloId')
        );*/
        //var_dump($modulo);
        $moduloId = $data['mod'];
        
        //$moduloId = $this->request->getVar('moduloId');

        //var_dump($moduloId);

        $modMenu = $rolModMenu->getModMenu($moduloId);

        $dato = [
            "modMenu" =>$modMenu
        ];

        echo json_encode($dato);
    }

}
