<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;

class BitacoraController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $mensaje = session('mensaje');

        $dato = [
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/bitacora', $dato);
    }

}
