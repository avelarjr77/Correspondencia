<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;

class MenuSubmenuController extends BaseController
{

    public function menu_submenu()
    {
        return view('modAdministracion/menu_submenu');
    }
}
