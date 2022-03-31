<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModMenuModel;

class RolModMenuController extends BaseController
{

    public function rolModMenu()
    {
        return view('modAdministracion/rolModMenu');
    }

    public function show()
    {
        $rolModMenu = new RolModMenuModel();

        $dataHeader =[
            'title' => 'Rol Módulo Menú'
        ];

        $data =[
            'rolModMenus' => $rolModMenu->asObject()->findAll()
        ];
    }

}
