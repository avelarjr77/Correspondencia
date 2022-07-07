<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\ModuloMenuModel;
use App\Models\modAdministracion\RolModMenuModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $rolModMenu = new RolModMenuModel();
        $ModuloMenu = new ModuloMenuModel();
        $nombreRol = new RolModel();
        $mensaje = session('mensaje');

        $datos = $rolModMenu->getRolMM();

        $dato = [
            "datos" => $datos,
            "rol" => $nombreRol->listarRol(),
            "ModuloM" => $ModuloMenu->asObject()
            ->select('mm.moduloMenuId, mo.nombre as Modulo, me.nombreMenu as Menu')
            ->from('co_modulo_menu mm')
            ->join('co_modulo mo', 'mo.moduloId=mm.moduloId')
            ->join('co_menu me', 'me.menuId=mm.menuId')
            ->groupBy('mm.moduloMenuId')
            ->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/rolModMenu', $dato);
    }

    public function crearRolModuloMenu(){
        $datos = [
            "rolId"        => $_POST['rolId'],
            "moduloMenuId"        => $_POST['moduloMenuId']
        ];

        $RolModuloMenu = new RolModMenuModel();
        $respuesta = $RolModuloMenu->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/rolModMenu')->with('mensaje','1');
        } else {
            return redirect()->to(base_url(). '/rolModMenu')->with('mensaje','0');
        }
    }


    public function editar()
    {
        $rolModMenu = new RolModMenuModel();

        $moduloId = $this->request->getVar('moduloId');

        $modMenu = $rolModMenu->getModMenu($moduloId);

        echo json_encode($modMenu);
    }

    public function menu()
    {
        $rolM = new RolModMenuModel();

        $rolId = $this->request->getVar('rolId');

        $rolMenu = $rolM->getRolMenu($rolId);

        echo json_encode($rolMenu);
    }

    public function editR()
    {

        $rolMod = new RolModMenuModel();
        if ($this->validate([
            'menu'        => 'required',
            'rolId'        => 'required'

        ])) {
            $datos = [
                $menu = $_POST['menu'],
                $rolId = $_POST['rolId']
            ];

            for ($i = 0; $i < count($menu); $i++) {
                $data = array('rolId' => $rolId, 'moduloMenuId' => $menu[$i]);
                $editar = $rolMod->insertar($data);
            }

            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '4');
        }
    }
    public function actualizar()
    {
        $datos = [
            "rolId"        => $_POST['rolId'],
            "moduloMenuId"        => $_POST['moduloMenuId']
        ];

        $moduloMenuId = $_POST['moduloMenuId'];

        $RolModuloMenu = new RolModMenuModel();
        $respuesta = $RolModuloMenu->actualizar($datos, $moduloMenuId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '5');
        }

    }

    public function eliminar()
    {

        $rolModuloMenuId = $_POST['rolModuloMenuId'];
        // $id = $this->request->getVar('id');

        $nombre = new RolModMenuModel();

        $data = ["rolModuloMenuId" => $rolModuloMenuId];

        $respuesta = $nombre->eliminarR($data);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '3');
        } else {
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '2');
        }
        //echo json_encode($respuesta);
    }
}
