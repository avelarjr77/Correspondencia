<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModMenuModel;
use App\Models\modAdministracion\RolModel;

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

    //FUNCION PARA TRAER EL NOMBRE DEL ROL
    public function obtenerRol($rolId)
    {
        $data = ["rolId" => $rolId];
        $rolModMenu = new RolModMenuModel();
        $respuesta = $rolModMenu->obtenerRol();

        $data = ["datos" =>$respuesta];

        return view('obtenerRol',$data);
    }

    //FUNCION EDITAR
    public function update($id)
    {
        $rol = $this->rol->findAll();
    }

}
