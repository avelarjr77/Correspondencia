<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModMenuModel;

class RolModMenuController extends BaseController
{
    public function rolModMenu()
    {
        $rolModMenu = new RolModMenuModel();

        

        $data =[
            'rolModMenus' => $rolModMenu->asObject()
        ];

        return view('modAdministracion/rolModMenu',$data);
    }

}
