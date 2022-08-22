<?php

namespace App\Controllers;

use App\Models\Usuarios;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modAdministracion\RolModMenuModel;
use App\Models\modAdministracion\MovimientosModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    protected $bitacora;

    public function index()
    {
        $mensaje = session('mensaje');
        $data = [
            "mensaje"   => $mensaje,
            "prueba" => fraseAleatoria()
        ];
        if (!session()->is_logged) {
            return redirect()->to(base_url('/'));
        }
        return view('homeModulos', $data);
    }

    public function login()
    {
        $session = \Config\Services::session();

        $usuario = trim($this->request->getVar('usuario'));
        $clave = $this->request->getVar('clave');

        

        $usuarios = model('Usuarios');
        $pass = $usuarios->obtenerUsuario('clave', $clave);

        $obtenerRol = new UsuarioModel();
        $rol =  $obtenerRol->asArray()->select('r.nombreRol')->from('wk_usuario u')
            ->join('wk_rol r', 'u.rolId=r.rolId')->where('u.usuario', $usuario)->first();

        if ($user = $usuarios->obtenerId('usuario', $usuario) && isset($pass['clave'])) {

            $data = array(
                'usuario' => $usuario,
                'rol' => $rol['nombreRol'],
                'is_logged' => true
            );

            //PARA REGISTRAR QUIEN INICIO SESSION
            $this->bitacora  = new MovimientosModel();

            $descripcion  = $_SERVER['REMOTE_ADDR'];
            $hora=new Time('now');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $usuario,
                'accion' => 'Inicio de sesión',
                'descripcion' => $descripcion,
                'hora' => $hora,
            ]);

            //END

            $session = session();
            $session->set($data);

            return redirect()->to(base_url('/homeModulos'))->with('success', '<strong>¡Bienvenido!</strong><br>'.$session->usuario);
        } else {
            return redirect()->to(base_url('/'))->with('danger', 'El usuario y contraseña no coiciden, intente de nuevo.');
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
            "modulo" => $modulo->asObject()->select('mm.moduloId, r.nombreRol AS rol, cmm.moduloMenuId, mm.nombre AS modulo')
                ->from('co_rol_modulo_menu m')
                ->join('wk_rol r', ' m.rolId=r.rolId')
                ->join('co_modulo_menu cmm', ' m.moduloMenuId= cmm.moduloMenuId')
                ->join('co_modulo mm', 'cmm.moduloId=mm.moduloId')
                ->where('r.nombreRol', $rol)
                ->groupBy('modulo')
                ->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('homeModulos', $data);
    }

    public function salir()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('/'));
    }
}
