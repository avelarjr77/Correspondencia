<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeMenusController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function index()
    {

        return view('homeMenus');
    }

}
