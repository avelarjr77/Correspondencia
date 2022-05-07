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

    public function modulo()
    {
        $rolMM = new RolModMenuModel();
       
        $moduloId = $this->request->getVar('moduloId');

        $modMenu = $rolMM->getModMenu($moduloId);
        
        echo json_encode($modMenu);
        
    }

    public function menu()
    {
        $rolM = new RolModMenuModel();

        $menuId = $this->request->getVar('menuId');

        $rolMenu = $rolM->getRolMenu($menuId);
        
        echo json_encode($rolMenu);
        
    }

    public function editR()
    {
        $rolMod = new RolModMenuModel();

        //$rolId = $this->request->getVar('rolId');

        $rolId= 2;

        $menu = $_POST['menu'];

        for ($i=0; $i < count($menu); $i++) 
        {
            $data = array('rolId' => $rolId, 'moduloMenuId' => $menu[$i]);
            $editar = $rolMod->insertar($data);
        }

        if ($editar> 0) {
            $r = "Exitoso";
        }else{
            $r = "Falló";
        }

        return redirect()->to(base_url(). '/rolModMenu');
        
        echo json_encode($r);
        
    }

    public function eliminar($id){

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
