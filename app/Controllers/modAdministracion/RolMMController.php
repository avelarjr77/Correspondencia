<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolMMModel;

class RolMMController extends BaseController
{
    //LISTADO  MENU
    public function editar()
    {
        /*$rolModMenu = new RolMMModel();

        $datos = $rolModMenu->getRolMM();

        $data = [
            "datos" =>$datos
        ];*/

        return view('modAdministracion/rolMM',$data);
    }

    //FUNCION PARA TRAER EDITAR
    public function editar($id)
    {
        $rolMM = new RolMMModel();

        $data = ["id" => $id];

        $respuesta = $rolMM->editar();

        $data = ["datos" =>$respuesta];

        return view('modAdministracion/editRolMM',$data);
    }

    //FUNCION EDITAR
    public function update($id)
    {
        $rol = $this->rol->findAll();
    }

}
