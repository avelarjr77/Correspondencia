<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ResetsModel;
use App\Models\modUsuario\PersonaModel;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\TipoContactoModel;

class Login extends BaseController
{

    public function index()
    {

        return view('login');
    }

    

    public function recuperarContraseña()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email[wk_contacto.contacto]',
                'usuario'=> 'required'
            ];

            $errors = [
                'email' => ['valid_email' => 'Email no existe, por favor verifique'],
                'usuario' => ['required' => 'Por favor, ingresar el usuario'],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new ContactoModel();
                $user = $model->where('contacto', $this->request->getVar('email'))
                    ->first();
                $usuario = $model->select('u.usuario')->from('wk_contacto c')
                    ->join('wk_usuario u', 'c.personaID=u.personaId')->where('c.contacto', $this->request->getVar('email'))
                    ->first();
                $session = session();
                $pass = new UsuarioModel();
                $clave = $pass->select('clave')->where('usuario', $usuario)
                    ->first();
                if ($user) {
                    $newReset = [
                        'ip_res'     => $this->request->getIPAddress(),
                        'email'      => $user['contacto'],
                        'clave'     => $clave,
                    ];
                    $rmodel = new ResetsModel();
                    $rmodel->insert($newReset);

                    $message = '
                     <tbody>
                        <tr>
                          <td style="background-color:#fff;text-align:left;padding:0">
                            <img width="100%" style="display:block" src="https://ci5.googleusercontent.com/proxy/P25cH7v50GgGMWFREqDuajcm2OkK3RY5n34zWsarDel-wtDsvs1Oljgt504DztdGajplibawaNrACXM7NVKg=s0-d-e1-ft#https://ucadvirtual.com/EduWS/encabezado.png" class="CToWUd a6T" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 816px; top: 64px;"><div id=":vp" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Descargar el archivo adjunto " data-tooltip-class="a1V" data-tooltip="Descargar"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
                          </td></tr>
            			      <tr>
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
            					          Hemos recibido una solicitud para recordar su contraseña.<br><br>
            					          A continuación, le mostramos su contraseña:<br>
            						      </p>
                              <h1 style="font-weight:bold;text-align:center">' . $clave['clave'] . '</h1><br>
                              <p style="margin:2px;font-size:15px"></p><p style="margin:2px;font-size:15px;font-weight:bold;display:inline">Nota:</p>Recuerde que la contraseña es personal y no debe compartirla con nadie más.<p></p>
            					        <p style="margin:2px;font-size:15px">Por favor, no responda a este mensaje ya que ha sido generado de forma automática.</p>
            						      <div style="width:100%;text-align:center;margin-top:10%">
            							      <a style="text-decoration:none;border-radius:5px;padding:11px 23px;color:white;background-color:#172d44" href="#">Ir a Login - Correspondencia</a>	
            						      </div>
            						  <p style="color:#b3b3b3;font-size:12px;text-align:center;margin:30px 0 0">Universidad Cristiana de las Asambleas de Dios - 2022</p>
            			        </div>
                            </td>
            		    </tr>
            		</tbody>';
                    $email = \Config\Services::email();
                    $email->setFrom('correspondencia-ucad@gmail.com', 'Recuperar Contraseña');
                    $email->setTo($user['contacto']);
                    $email->setSubject('Recuperar Contraseña');
                    $email->setMessage($message);
                    if ($email->send()) {
                        $session->setFlashdata('success', 'Se ha enviado un correo electrónico para recordar la contraseña');
                    } else {
                        $session->setFlashdata('danger', 'Error en el envío, por favor intenta más tarde.');
                    }
                } else {
                    $session->setFlashdata('danger', 'El email y usuario no coiciden, por favor verifique.');
                }
            }
        }
        return view('login', $data);
    }
}
