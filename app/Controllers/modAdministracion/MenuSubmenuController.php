<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\MenuSubmenuModel;

class MenuSubmenuController extends BaseController
{

    public function menu_submenu()
    {
        $MenuSubmenu = new MenuSubmenuModel();

        $datos = $MenuSubmenu->listarMenu();

        $data = [
            "datos" => $datos 
        ];

        return view('modAdministracion/menu_submenu', $data);
    }
}
