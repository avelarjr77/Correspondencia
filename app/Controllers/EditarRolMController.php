<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModMenuModel;

class EditarRolMController extends BaseController
{
    
    public function editar($moduloId, $rolId)
    {
        $rolModMenu = new RolModMenuModel();

        //$moduloId = $this->request->getVar('moduloId');
        //$rolId = $this->request->getVar('rolId');

        $modMenu = $rolModMenu->getModMenu($moduloId);
        $rolMenu = $rolModMenu->getRolMenu($rolId);

        $dato = [
            "modMenu" => $modMenu,
            "rolMenu" => $rolMenu
        ];

        //return view('template/header');
        echo view('editRolModMenu', $dato);
       // return view('template/footer');
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

        $rolModuloMenuId = $_POST['rolModuloMenuId'];

        $nombre = new RolModMenuModel();
        
        $data = ["rolModuloMenuId" => $rolModuloMenuId];

        $respuesta = $nombreRol->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/rolModMenu')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/rolModMenu')->with('mensaje','3');
        }
    }

}
