<?php

namespace App\Controllers\modAdministracion;

use mysqli;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\IconoModel;
use App\Models\modAdministracion\SubmenuModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\modAdministracion\MenuSubmenuModel;
use App\Models\modAdministracion\MovimientosModel;

class MenuSubmenuController extends BaseController
{
    //Funcion para MOSTRAR DATOS DE LA TABLA MENU
    public function menu_submenu()
    {
        $menu   = new MenuSubmenuModel();
        $submenu= new SubmenuModel();
        $icono  = new IconoModel();

        $mensaje = session('mensaje');

        $data = [
            "submenu"   => $submenu->select()->asObject()->join('co_menu','co_menu.menuId = co_submenu.menuId')->findAll(),
            "menu"      => $menu->asObject()->join('wk_icono','wk_icono.iconoId = co_menu.iconoId')->findAll(),
            "icono"     => $icono->asObject()->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/menu_submenu', $data);
    }

    //Funcion para INSERTAR
    public function crear()
    {
        $menu = new MenuSubmenuModel();

        if ($this->validate('menuValidation')) {
            $menu->insertar(
                [
                    'nombreMenu'=> $this->request->getPost('nombreMenu'),
                    'iconoId'   => $this->request->getPost('iconoId'),
                ]
            );
            //PARA REGISTRAR EN BITACORA QUIEN CREO MENÚ
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó menú',
                'descripcion'   => $_POST['nombreMenu'],
                'hora'          => $hora,
            ]);
            //END
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '1');
        }

        //Mensaje si el registro esta duplicado
        return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '6');
    }

    public function eliminar()
    {
        $menuId = $_POST['menuId'];

        $menu       = new MenuSubmenuModel();
        $submenu    = new SubmenuModel();
        $nombreMenu = $menu->asArray()->select("nombremenu")
        ->where("menuId", $menuId)->first();

        $data = ["menuId" => $menuId,];

        //Para buscar si el menú está relacionado con un submenu
        $buscarRelacion = $submenu->select('menuId')->where('menuId', $menuId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '7');
        }

        $respuesta = $menu->eliminar($data);

        if ($respuesta) {
            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO MENÚ
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó menú',
                'descripcion'   => $nombreMenu,
                'hora'          => $hora,
            ]);
            //END
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
            'nombreMenu' => 'required|alpha_space',
            'iconoId' => 'required',
        ])) {
            $datos = [
                "nombreMenu" => $_POST['nombreMenu'],
                "iconoId"    => $_POST['iconoId'],
            ];

            $menuId = $_POST['menuId'];


            $respuesta = $menu->actualizar($datos, $menuId);
            $datos = ["datos" => $respuesta];

            //PARA REGISTRAR EN BITACORA QUIEN EDITO MENÚ
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Editó menú',
                'descripcion'   => $_POST['nombreMenu'],
                'hora'          => $hora,
            ]);
            //END
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/menu_submenu')->with('mensaje', '3');
        }
    }
}