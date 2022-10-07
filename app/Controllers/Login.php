<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modUsuario\ContactoModel;
use App\Models\modAdministracion\MovimientosModel;

class Login extends BaseController
{

    public function index()
    {

        return view('login');
    }

    public function __construct()
    {
        helper(['system_helper']);
    }

    public function login()
    {
        $session = \Config\Services::session();

        $usuarios = new UsuarioModel();
        $usuario = trim($this->request->getVar('usuario'));
        $clave = $this->request->getVar('clave');
        $buscarUsuario = $usuarios->select('u.usuario as usuario')->from('wk_usuario u')
        ->where('u.usuario', $usuario)->first();

        if (!$buscarUsuario) {
            return redirect()->to(base_url('/'))->with('danger', 'Lo sentimos, este usuario no existe. intente de nuevo.');
        }

        $claveCifrada = $usuarios->asArray()->select('clave')->where('usuario', $usuario)
            ->first();

        //Para desencriptar contraseña y poder iniciar sesion
        $claveDesencriptada = password_verify($clave, $claveCifrada['clave']);

        //return $clave . '<br>'. $claveCifrada['clave']. '<br>'.$claveDesencriptada;

        $obtenerRol = new UsuarioModel();
        $rol =  $obtenerRol->asArray()->select('r.nombreRol')->from('wk_usuario u')
            ->join('wk_rol r', 'u.rolId=r.rolId')->where('u.usuario', $usuario)->first();


        if ($claveDesencriptada == 1) {

            $data = array(
                'usuario' => $usuario,
                'rol' => $rol['nombreRol'],
                'is_logged' => true
            );

            //PARA REGISTRAR QUIEN INICIO SESSION
            $this->bitacora  = new MovimientosModel();

            $descripcion  = $this->request->getUserAgent();
            $hora = new Time('now');

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

            return redirect()->to(base_url('/homeModulos'))->with('success', '<strong>¡Bienvenido!</strong><br>' . $session->usuario);
        } else {
            return redirect()->to(base_url('/'))->with('danger', 'El usuario y contraseña no coiciden, intente de nuevo.');
        }
    }

    public function recuperarContraseña()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email[wk_contacto.contacto]',
            ];

            $errors = [
                'email' => ['valid_email' => 'Email no existe, por favor verifique'],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new ContactoModel();
                $usuario = new UsuarioModel();
                $user = $model->where('contacto', $this->request->getVar('email'))
                    ->first();
                $usuarioId = $usuario->asArray()->select('u.usuarioId')
                    ->from('wk_persona p')
                    ->join('wk_contacto c', 'p.personaId=c.personaId')
                    ->join(' wk_usuario u', 'p.personaId=u.personaId')
                    ->where('c.contacto', $this->request->getVar('email'))
                    ->groupBy('u.usuarioId')
                    ->first();

                $session = session();

                $pass    = new UsuarioModel();
                helper(['form']);
                $clave = fraseAleatoria();
                $claveCifrada = password_hash($clave, PASSWORD_BCRYPT); //JVSJV<SV<SVY32YIW2YEGUY2VDHQ
                if ($user) {
                    $newReset = [
                        'email'      => $user['contacto'],
                        'clave'     => $clave,
                    ];

                    $datos = [
                        "clave"     => $claveCifrada,
                    ];

                    $respuesta = $usuario->actualizar($datos, $usuarioId);
                    $d = ["datos" => $respuesta];
                    $anio = date('Y');

                    $message = '
                    <tbody style="background-color:#FFFFFF;>
                        <tr>
                            <td style="background-color:#fff;text-align:left;padding:0">
                                <img width="100%" style="display:block" src="https://ci5.googleusercontent.com/proxy/P25cH7v50GgGMWFREqDuajcm2OkK3RY5n34zWsarDel-wtDsvs1Oljgt504DztdGajplibawaNrACXM7NVKg=s0-d-e1-ft#https://ucadvirtual.com/EduWS/encabezado.png" class="CToWUd a6T" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 816px; top: 64px;"><div id=":vp" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Descargar el archivo adjunto " data-tooltip-class="a1V" data-tooltip="Descargar"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#fff;text-align:left;padding:0">
                                Soporte Técnico | Correspondencia UCAD<br><hr
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#ffffff">
                                <div style="color:#34495e;margin:4% 10% 2%;text-align:justify;font-family:sans-serif">
                                    <h2 style="color:#003366;margin:0 0 7px">Buen día, estimado(a).</h2><br>
                                <p style="margin:2px;font-size:15px">
                                Hemos recibido una solicitud para restablecer su contraseña.<br><br>
                                A continuación, le mostramos su contraseña temporal para iniciar sesió y restablecer una nueva contraseña:<br>
                                </p>
                                <h1 style="font-weight:bold;text-align:center">' . $clave . '</h1><br>
                                <p style="margin:2px;font-size:15px"></p><p style="margin:2px;font-size:15px;font-weight:bold;display:inline">Nota:</p>Recuerde que la contraseña es personal y no debe compartirla con nadie más.<p></p>
                                <p style="margin:2px;font-size:15px">Por favor, no responda a este mensaje ya que ha sido generado de forma automática.</p>
                                <div style="width:100%;text-align:center;margin-top:10%">
                                <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
                                </div>
                                <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - ' . $anio . '</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>';
                    $email = \Config\Services::email();
                    $email->setFrom('correspondencia.ucad@gmail.com', 'Restablecer Contraseña');
                    $email->setTo($user['contacto']);
                    $email->setSubject('Recuperar Contraseña');
                    $email->setMessage($message);
                    if ($email->send()) {
                        $session->setFlashdata('success', 'Se ha enviado un correo electrónico con una contraseña temporal para que pueda restablecer una nueva');
                    } else {
                        $session->setFlashdata('danger', 'Error en el envío, por favor intenta más tarde.');
                    }
                } else {
                    $session->setFlashdata('danger', 'Este email no esta registrado, por favor verifique.');
                }
            }
        }
        return redirect()->to(base_url(). '/');
    }
}
