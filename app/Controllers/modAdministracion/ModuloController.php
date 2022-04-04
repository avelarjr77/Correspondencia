<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloModel;

class ModuloController extends BaseController
{

    public function modulo()
    {
        $Modulo = new ModuloModel();

        $data = [
            'moduloId'   => $moduloId->asObject()->findAll()
        ];

        return view('modAdministracion/adminModulo', $data);
    }
}
