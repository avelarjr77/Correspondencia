<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloModel;

class HomeMenusController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function index()
    {
        $session = \Config\Services::session();
        $modulo = $_POST['moduloId'];
        //para obtener el Id de modulo por medio de session
        $dataM=[
            "modulo" => $modulo,
            'is_logged' => true,
        ];
        $session = session();

        $session->set($dataM);

        $mod = new ModuloModel();
        $data=[
            'title'	=> 'Correspondencia UCAD | Home',
            ];
        return view('homeMenus', $data);
        return view ('/template/admin_template', $dataM);
    }
    public function homeMenu()
    {

        $data=[
            'title'	=> 'Correspondencia UCAD | Home',
            ];
        return view('homeMenus', $data);
    }

}
