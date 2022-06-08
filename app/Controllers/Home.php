<?php

namespace App\Controllers;

use App\Models\RolModel;
use App\Models\Usuarios;
use App\Models\modAdministracion\RolModMenuModel;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->is_logged) {
            return redirect()->to(base_url('/'));
        }
        $mensaje = session('mensaje');
        return view('homeModulos', ["mensaje" => $mensaje]);
    }

    public function login()
    {
        //dd($this->request->getPost());
        $usuario = trim($this->request->getVar('usuario'));
        $clave = $this->request->getVar('clave');

        $usuarios = model('Usuarios');
        $pass = $usuarios->obtenerUsuario('clave', $clave);

        if ($user = $usuarios->obtenerUsuario('usuario', $usuario) && isset($pass['clave'])) {

            $data = array(
                'usuario' => $usuario,
                'is_logged' => true
            );

            $session = session();
            $session->set($data);

            return redirect()->to(base_url('/homeModulos'))->with('mensaje', '0');
        } else {
            return redirect()->to(base_url('/'))->with('mensaje', '1');
        }
    }

    public function modulo()
    {
        $session = session();
        $modulo = new RolModMenuModel();
        $obtenerRol = new Usuarios();
        $rol =  $obtenerRol->asArray()->select('r.nombreRol')->from('wk_usuario u')
            ->join('wk_rol r', 'u.rolId=r.rolId')->where('u.usuario', $session->usuario)->first();

        $mensaje = session('mensaje');

        $data = [
            "modulo" => $modulo->asObject()->select('mm.moduloId, r.nombreRol AS rol, cmm.moduloMenuId, mm.nombre AS modulo, i.nombreIcono as icono, mm.descripcion, mm.archivo')
                ->from('co_rol_modulo_menu m')
                ->join('wk_rol r', ' m.rolId=r.rolId')
                ->join('co_modulo_menu cmm', ' m.moduloMenuId= cmm.moduloMenuId')
                ->join('co_modulo mm', 'cmm.moduloId=mm.moduloId')
                ->join('wk_icono i', 'mm.iconoId=i.iconoId')
                ->where('r.nombreRol', $rol)
                ->groupBy('modulo')
                ->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('homeModulos', $data);
    }

    public function homeMenuModulo($moduloId)
    {
        $datosModulo = ["moduloId" => $moduloId];
        return redirect()->to(base_url('template/admin_template' . $datosModulo));
    }
    public function salir()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('/'));
    }
}
?>
