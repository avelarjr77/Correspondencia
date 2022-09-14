<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\DepartamentoModel;
use App\Models\modUsuario\TipoContactoModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modTransaccion\TransaccionConfigModel;

class PerfilController extends BaseController
{

    //LISTAR CONTACTOS

    public function index()
    {
        $actividad = new MovimientosModel();
        $usuario = new UsuarioModel();
        $nombreProceso = new TransaccionConfigModel();

        $user = session('usuario');

        $mensaje = session('mensaje');

        $data = [
            "persona" =>$usuario->asObject()
            ->select('u.usuarioId, u.usuario, p.nombres, p.primerApellido')
            ->from('wk_usuario u')
            ->join('wk_persona p'       ,'u.personaId=p.personaId')
            ->where('u.usuario'         , $user)
            ->groupBy('u.usuarioId')->findAll(),

            "direccion" => $usuario->asObject()
            ->select('u.usuarioId, u.usuario, d.nombreDireccion as direccion, mu.nombreMunicipio as municipio, dep.nombreDepto as departamento')
            ->from('wk_usuario u')
            ->join('wk_persona p'   ,'u.personaId=p.personaId')
            ->join('wk_direccion d' ,'p.personaId=d.personaId')
            ->join('wk_municipio mu','d.municipioId= mu.municipioId')
            ->join('wk_depto dep'   ,'mu.deptoId=dep.deptoId')
            ->where('u.usuario'     , $user)
            ->groupBy('u.usuarioId')->findAll(),

            "departamento" => $usuario->asObject()
            ->select('d.departamento as departamento')
            ->from('wk_usuario u')
            ->join('wk_persona p'       ,'u.personaId=p.personaId')
            ->join('wk_departamento d'  ,'p.departamentoId=d.departamentoId')
            ->where('u.usuario'         , $user)
            ->groupBy('u.usuarioId')->findAll(),

            "actividad" => $actividad->asObject()
            ->select('b.fecha, b.accion, b.descripcion')
            ->from('wk_bitacora b')
            ->where('b.usuario',$user)
            ->groupBy('b.bitacoraId')->findAll(),

            "procesos" => $nombreProceso->asObject()
            ->select('t.transaccionId as id, p.nombreProceso as proceso,
            i.nombreInstitucion as institucion,  pe.nombres as persona')
            ->from('wk_transaccion t')
            ->join('wk_proceso p'       ,'p.procesoId = t.procesoId')
            ->join('wk_institucion i'   ,'i.institucionId = t.institucionId')
            ->join('wk_persona pe'      ,'pe.personaId = t.personaId')
            ->join('wk_usuario u'       ,'pe.personaId=u.personaId')
            ->where('u.usuario'         ,$user)
            ->groupBy('t.transaccionId')->findAll(),

            "mensaje" => $mensaje
        ];

        return view('perfil', $data);
    }

    public function editarPerfil()
    {
        $usuario    = new UsuarioModel();

        $usuarioId  = $_POST['usuarioId'];


        $datosU = [
            "usuario"    => $_POST['usuario']
        ];

        $respuesta = $usuario->actualizar($datosU, $usuarioId);
        $datos = ["datos" => $respuesta];

        return redirect()->to(base_url(). '/perfil')->with('mensaje','0');

    }

    public function nuevaContraseña()
    {
        $usuarioId = $_POST['usuarioId'];
        $clave    = $_POST['clave'];
        $nueva    = $_POST['nueva'];
        $usuario = session('usuario');
        $pass = new UsuarioModel();

        $claveCifrada = $pass->asArray()->select('clave')->where('usuario', $usuario)
        ->first();

        //Para desencriptar la contraseña y poder ingresar al sistema
        $claveDesencriptada =password_verify($clave, $claveCifrada['clave']);


        if ($claveDesencriptada == 1) {

            $nuevaCifrada = password_hash($nueva, PASSWORD_BCRYPT);

            $datos = [
                "clave"     => $nuevaCifrada,
            ];


        $respuesta = $pass->actualizar($datos, $usuarioId);

        $datos = ["datos" => $respuesta];

        return redirect()->to(base_url(). '/perfil')->with('mensaje','2');
        }else{
            return redirect()->to(base_url(). '/perfil')->with('mensaje','3');
        }
    }
}
