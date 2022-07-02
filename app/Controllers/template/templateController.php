<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\MenuSubmenuModel;
use App\Models\modAdministracion\SubmenuModel;

class TemplateController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA SUBMENU
    public function admin_template()
    {
        $menu = new MenuSubmenuModel();
        $submenu = new SubmenuModel();

        $data = [
            "submenu"  => $submenu->select()->asObject()->findAll(),
            "menu"     => $menu->select()->asObject()
            ->where('nombreSubMenu', 'menuId = menuId')
            ->join('wk_icono','wk_icono.iconoId = co_menu.iconoId')
            ->join('co_submenu','co_submenu.menuId = co_menu.menuId')
            ->findAll()
        ];

        return view('template/admin_template', $data);
    }
}