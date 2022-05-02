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

        //$moduloId = $this->request->post();;
        //$moduloId = $this->request->getVar('moduloId');
        //$moduloId = $POST['moduloId'];
        //$data['users'] = $model->getUsers();

        //var_dump($moduloId);

        $datos = $rolModMenu->getRolMM();
        //$modMenu = $rolModMenu->getModMenu($moduloId);

        $dato = [
            "datos" => $datos
        ];
        //var_dump($dato);

        return view('modAdministracion/rolModMenu',$dato);
    }

    public function modulo()
    {
        //$moduloId = $POST['moduloId'];
        //$moduloId = $this->request->getVar('moduloId');

        $rolMM = new RolModMenuModel();
        /*$respuesta = $rolMM->getModMenu($moduloId);

        $dato = ["modMenu" => $respuesta];
        return view('modAdministracion/editRolMM',$dato);*/

       
        $moduloId = $this->request->getVar('moduloId');
        //print_r($moduloId);

        $modMenu = $rolMM->getModMenu($moduloId);

        $id="id";

        $data = [
            "list" => $modMenu,
            "moduloId" => $moduloId,
            "id" =>$id
        ];
        
        echo json_encode($data);
        
    }

}
