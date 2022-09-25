<?php

namespace App\Controllers;

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
        ];
        return view('homeModulos', $data);
    }


    public function modulo()
    {
        $session = session();
        $modulo = new RolModMenuModel();
        $obtenerRol = new UsuarioModel();
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
