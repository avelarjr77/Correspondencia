<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\IconoModel;
use App\Models\modAdministracion\SubmenuModel;
use App\Models\modAdministracion\MenuSubmenuModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use mysqli;

class HomeAdministracionController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function index()
    {

        return view('modAdministracion/homeAdministracion');
    }

}