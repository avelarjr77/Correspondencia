<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\TipoContactoModel;

class PerfilController extends BaseController
{

    //LISTAR CONTACTOS

    public function index()
    {

        return view('perfil');
    }
}
