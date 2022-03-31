<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\MenuSubmenuModel;
use App\Models\SubmenuModel;

class MenuSubmenuController extends BaseController
{

    public function menu_submenu()
    {
        $MenuSubmenu = new MenuSubmenuModel();
        $datos = $MenuSubmenu->listarMenu();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/menu_submenu', $data);
    }

    public function crear(){
        $datos = [
            "nombreMenu"    => $_POST['nombreMenu']
        ];
        $nombreMenu = new MenuSubmenuModel();
        $respuesta = $nombreMenu->insertar($datos);
        if ($respuesta > 0){
            return redirect()->to(base_url().'/menu_submenu')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url().'/menu_submenu')->with('mensaje', '0');
        }

    }

    public function listarSubmenu(){
        $submenu = new SubmenuModel();
        var_dump($submenu->asObject()->findAll());
    }

    public function nombreSubMenu()
    {
        $nombreSubMenu = new SubmenuModel();
        /*$dataHeader =[
            'title' => 'Submenus'
        ];*/

        $data = [
            'nombreSubMenu'   => $nombreSubMenu->asObject()->findAll()
        ];

        return view('modAdministracion/menu_submenu', $data);
    }
}
