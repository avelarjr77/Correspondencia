<?php namespace App\Controllers\modAdministracion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\ModuloModel;
use App\Models\modAdministracion\ModuloMenuModel;
use App\Models\modAdministracion\MenuSubMenuModel;
use App\Models\modAdministracion\MovimientosModel;

class ModuloMenuController extends BaseController{

    
    //LISTAR MODULOS MENUS
    public function moduloMenu(){

        $ModuloMenu = new ModuloMenuModel();

        $mensaje = session('mensaje');

        $data = [
            "ModuloM" => $ModuloMenu->listarModuloMenu(),
            "menu" => $ModuloMenu->listarMenu(),
            "modulo" => $ModuloMenu->listarModulo(),
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

        /*$nombreMenu = $ModuloMenu->asArray()->select("nombreMenu")
        ->join("co_menu",'co_menu.menuId = co_modulo_menu.menuId')->where("moduloMenuId", $_POST['moduloId'])
        ->first();
        $nombreModulo = $ModuloMenu->asArray()->select("nombre")
        ->join("co_modulo",'co_modulo.moduloId = co_modulo_menu.moduloId')
        ->where("moduloMenuId", $_POST['menuId'])
        ->first();*/

        //PARA REGISTRAR EN BITACORA QUIEN CREO EL MODULO-MENÚ
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId' => null,
            'usuario' => $session,
            'accion' => 'Agregó Módulo-Menú',
            'descripcion' => $_POST['moduloId'].'/'.$_POST['menuId'],
            'hora' => $hora,
        ]);
        //END

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/moduloMenu')->with('mensaje','1');
        }
    }

    //ELIMINAR MODULOS
    public function eliminar(){

        $moduloMenuId = $_POST['moduloMenuId'];

        $ModuloMenu = new ModuloMenuModel();
        $data = ["moduloMenuId" => $moduloMenuId];

        $respuesta = $ModuloMenu->eliminar($data);

        if ($respuesta > 0){
            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO EL MODULO-MENÚ
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $session,
                'accion' => 'Eliminó Módulo-Menú',
                'descripcion' => $moduloMenuId,
                'hora' => $hora,
            ]);
            //END
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

        //PARA REGISTRAR EN BITACORA QUIEN CREO EL MODULO-MENÚ
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId' => null,
            'usuario' => $session,
            'accion' => 'Editó Módulo-Menú',
            'descripcion' => $_POST['moduloId'].'/'.$_POST['menuId'],
            'hora' => $hora,
        ]);
        //END

        if ($respuesta) {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/moduloMenu')->with('mensaje', '5');
        }

    }    

    
}

?>