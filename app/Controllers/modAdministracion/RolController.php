<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;

class RolController extends BaseController
{

    public function rol()
    {
        $rol = new RolModel();

        $data = [
            'rols' => $rol->findAll()
        ];

        return view('modAdministracion/adminRol', $data);
    }
}
