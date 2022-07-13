<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\IconoModel;
use App\Models\modAdministracion\SubmenuModel;
use App\Models\modAdministracion\MenuSubmenuModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use mysqli;

class MenuSubmenuController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function menu_submenu()
    {
        $menu = new MenuSubmenuModel();
        $submenu = new SubmenuModel();
        $icono = new IconoModel();

        $mensaje = session('mensaje');

        $data = [
            "submenu"     => $submenu->select()->asObject()->join('co_menu','co_menu.menuId = co_submenu.menuId')->findAll(),
            "menu" => $menu->asObject()->join('wk_icono','wk_icono.iconoId = co_menu.iconoId')->findAll(),
            "icono" => $icono->asObject()->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/menu_submenu', $data);
    }

    //Funcion para validar el Menú
    public function new()
    {
        session('mensaje');
        $validation = \Config\Services::validation();

        var_dump($validation->listErrors());
        return view('modAdministracion/menu_submenu');
    }

    //Funcion para INSERTAR
    public function crear()
    {
        $menu = new MenuSubmenuModel();

        if ($this->validate('menuValidation')) {
            $menu->insertar(
                [
                    'nombreMenu' => $this->request->getPost('nombreMenu'),
                    'iconoId' => $this->request->getPost('iconoId'),
                ]
            );
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '1');
        }

        //Mensaje si el registro esta duplicado
        return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '6');
    }

    public function eliminar()
    {
        $menuId = $_POST['menuId'];

        $menu = new MenuSubmenuModel();

        $data = ["menuId" => $menuId];

        $respuesta = $menu->eliminar($data);

        if ($respuesta) {
            return redirect()->to(base_url().'/menu_submenu')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url().'/menu_submenu')->with('mensaje', '5');
        }
    }

    //Funcion para EDITAR
    public function actualizar($menuId = null)
    {
        $menu = new MenuSubmenuModel();
        if ($this->validate([
            'nombreMenu' => 'required|is_unique[co_menu.nombreMenu]|alpha_space',
            'iconoId' => 'required',
        ])) {
            $datos = [
                "nombreMenu" => $_POST['nombreMenu'],
                "iconoId"    => $_POST['iconoId'],
            ];

            $menuId = $_POST['menuId'];


            $respuesta = $menu->actualizar($datos, $menuId);
            $datos = ["datos" => $respuesta];

            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '3');
        }
    }
}