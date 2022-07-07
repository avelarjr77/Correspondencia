<?php

namespace App\Controllers\modReportes;

use App\Controllers\BaseController;

class ReportesController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $mensaje = session('mensaje');

        $dato = [
            "mensaje"   => $mensaje
        ];

        return view('modReportes/reportes', $dato);
    }

}
