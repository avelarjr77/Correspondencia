<?php

namespace App\Controllers\modAdministracion;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\ModuloMenuModel;
use App\Models\modAdministracion\RolModMenuModel;
use App\Models\modAdministracion\MovimientosModel;

class RolModMenuController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $rolModMenu = new RolModMenuModel();
        $ModuloMenu = new ModuloMenuModel();
        $nombreRol  = new RolModel();
        $mensaje    = session('mensaje');

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
            "rolId"         => $_POST['rolId'],
            "moduloMenuId"  => $_POST['moduloMenuId']
        ];

        //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL ROL-MÓDULO-MENÚ
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó Rol-Módulo-Menú',
            'descripcion'   => $_POST['rolId'].'/'.$_POST['moduloMenuId'],
            'hora'          => $hora,
        ]);
        //END

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

        $moduloId   = $this->request->getVar('moduloId');

        $modMenu    = $rolModMenu->getModMenu($moduloId);

        echo json_encode($modMenu);
    }

    public function menu()
    {
        $rolM   = new RolModMenuModel();

        $rolId  = $this->request->getVar('rolId');

        $rolMenu= $rolM->getRolMenu($rolId);

        echo json_encode($rolMenu);
    }

    public function editR()
    {

        $rolMod = new RolModMenuModel();
        if ($this->validate([
            'menu'      => 'required',
            'rolId'     => 'required'

        ])) {
            $datos = [
                $menu   = $_POST['menu'],
                $rolId  = $_POST['rolId']
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
        $RolModuloMenu = new RolModMenuModel();

        $datos = [
            "rolId"         => $_POST['rolId'],
            "moduloMenuId"  => $_POST['moduloMenuId']
        ];

        $rolModuloMenuId = $_POST['rolModuloMenuId'];

        $respuesta = $RolModuloMenu->actualizar($datos, $rolModuloMenuId);

        //PARA REGISTRAR EN BITACORA QUIEN EDITO EL ROL-MODULO-MENÚ
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó Rol-Módulo-Menú',
            'descripcion'   => $_POST['rolId'] . $_POST['moduloMenuId'],
            'hora'          => $hora,
        ]);
        //END

        if ($respuesta > 0) {
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
            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO EL ROL-MODULO-MENÚ
            $this->bitacora  = new MovimientosModel();
            $hora   =new Time('now');
            $session= session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó Rol-Módulo-Menú',
                'descripcion'   => $rolModuloMenuId,
                'hora'          => $hora,
            ]);
            //END
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '3');
        } else {
            return redirect()->to(base_url() . '/rolModMenu')->with('mensaje', '2');
        }
    }
}
