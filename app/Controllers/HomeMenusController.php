<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modAdministracion\ModuloModel;
use App\Models\modTransaccion\TransaccionActividadModel;

class HomeMenusController extends BaseController
{
    //FUNCIÓN para MOSTRAR LOS MENUS DEL MODULO SELECCIONADO
    public function index()
    {
        $session = \Config\Services::session();
        $modulo = $_POST['moduloId'];
        //para obtener el Id de modulo por medio de session
        $dataM=[
            "modulo" => $modulo,
            'is_logged' => true,
        ];
        $session = session();

        $session->set($dataM);
        return view ('/template/admin_template', $dataM);
    }
    
    //FUNCIÓN para MOSTRAR LOS DATOS DE INICIO
    public function homeMenu()
    {
        $session = \Config\Services::session();
        $usuario = $session->usuario;

        $tact = new UsuarioModel();
        $persona = $tact->asArray()->select('u.usuarioId, p.departamentoId')
                                    ->from('wk_usuario u')
                                    ->join('wk_persona p', 'u.personaId = p.personaId')
                                    ->where('u.usuario', $session->usuario)
                                    ->first();

        $transaccion = new TransaccionActividadModel();
        $actPendientes = $transaccion->actividadesPendientes($persona['usuarioId']);
        $prPendientes = $transaccion->procesosEncargados($persona['usuarioId']);
        $etapasActivas = $transaccion->etapasActivas($persona['usuarioId']);
        $usuariosTotal = $transaccion->totalUsuarios($persona['usuarioId'], $persona['departamentoId']);

        $data=[
            'actPendientes'	=> $actPendientes,
            'prActivo'	=> $prPendientes,
            'etapasActivas'	=> $etapasActivas,
            'usuariosTotal'	=> $usuariosTotal
        ];

        return view('homeMenus', $data);
    }

}