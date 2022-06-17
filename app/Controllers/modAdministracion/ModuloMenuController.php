<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloMenuModel;
use App\Models\modAdministracion\ModuloModel;
use App\Models\modAdministracion\MenuSubMenuModel;

class ModuloMenuController extends BaseController{

    
    //LISTAR MODULOS MENUS
    public function moduloMenu(){

        $ModuloMenu = new ModuloMenuModel();
        $modulo = new ModuloModel();
        $menu = new MenuSubMenuModel();

        $mensaje = session('mensaje');

        $data = [
            "ModuloM" => $ModuloMenu->asObject()->join('co_menu','co_menu.menuId = co_modulo_menu.menuId')->findAll(),
            "menu" => $menu->asObject()->findAll(),
            "modulo" => $modulo->asObject()->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/moduloMenu', $data);
        }

    //CREAR MODULOS MENUS
    public function crearModuloMenu(){


        $datos = [
            "moduloId"        => $_POST['moduloId'],
            "menuId"        => $_POST['menuId']
        ];

        $ModuloMenu = new ModuloMenuModel();
        $respuesta = $ModuloMenu->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','1');
        }
/*
        $ModuloMenu = new ModuloMenuModel();
        if($this->validate('validarModuloMenu')){
            $ModuloMenu->insertar(
                [
                    "moduloId"        => $_POST['moduloId'],
                    "menuId"        => $_POST['menuId']
                ]
            );

            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','1');
*/
    } 

    //ELIMINAR MODULOS
    public function eliminar(){

        $moduloMenuId = $_POST['moduloMenuId'];

        $ModuloMenu = new ModuloMenuModel();
        $data = ["moduloMenuId" => $moduloMenuId];

        $respuesta = $ModuloMenu->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $datos = [
            "moduloId" => $_POST['moduloId'],
            "menuId" => $_POST['menuId']
        ];

        $moduloMenuId = $_POST['moduloMenuId'];

        $ModuloMenu = new ModuloMenuModel();
        $respuesta = $ModuloMenu->actualizar($datos, $moduloMenuId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '5');
        }

    }    

    
}

?>