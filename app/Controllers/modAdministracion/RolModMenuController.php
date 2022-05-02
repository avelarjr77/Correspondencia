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
        $moduloId = $this->request->getVar('moduloId');
        //$moduloId = $POST['moduloId'];
        //$data['users'] = $model->getUsers();

        //var_dump($moduloId);

        $datos = $rolModMenu->getRolMM();
        $modMenu = $rolModMenu->getModMenu($moduloId);

        $dato = [
            "datos" => $datos,
            "modMenu" => $modMenu
        ];
        //var_dump($dato);

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
