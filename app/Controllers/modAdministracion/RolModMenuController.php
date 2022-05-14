<?php

namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\RolModMenuModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $rolModMenu = new RolModMenuModel();

        $datos = $rolModMenu->getRolMM();

        $dato = [
            "datos" => $datos
        ];

        return view('modAdministracion/rolModMenu',$dato);
    }

    /*public function modulo)
    
        $rolMM = new RolModMenuModel();
       
        $moduloId = $this->request->getVar('moduloId');

        $modMenu = $rolMM->getModMenu($moduloId);
        
        echo json_encode($modMenu);
        
    }*/

    public function editar()
    {
        $rolModMenu = new RolModMenuModel();

        $moduloId = $this->request->getVar('moduloId');

        $modMenu = $rolModMenu->getModMenu($moduloId);
        //$rolMenu = $rolModMenu->getRolMenu($rolId);

        /*$dato = [
            "modMenu" => $modMenu,
            "rolMenu" => $rolMenu
        ];*/

        echo json_encode($modMenu);
        //return view('template/header');
        //return view('modAdministracion/editRolModMenu', $dato);
       // return view('template/footer');
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

        $menu = $_POST['menu'];
        $rolId = $_POST['rolId'];

        for ($i=0; $i < count($menu); $i++) 
        {
            $data = array('rolId' => $rolId, 'moduloMenuId' => $menu[$i]);
            $editar = $rolMod->insertar($data);
        }

        return redirect()->to(base_url(). '/rolModMenu');
    }

    public function eliminar(){

        //$rolModuloMenuId = $_POST['rolModuloMenuId'];
        $id = $this->request->getVar('id');

        $nombre = new RolModMenuModel();
        
        //$data = ["rolModuloMenuId" => $rolModuloMenuId];

        $respuesta = $nombre->eliminarR($id);

        /*if ($respuesta > 0)
            return redirect()->to(base_url(). '/rolModMenu')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/rolModMenu')->with('mensaje','3');
        }*/
        echo json_encode($respuesta);
    }

}
