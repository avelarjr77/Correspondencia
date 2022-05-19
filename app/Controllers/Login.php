<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ResetsModel;
use App\Models\modUsuario\PersonaModel;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modUsuario\ContactoModel;

class Login extends BaseController
{
    public function __construct()
    {
        helper(['url', 'session', 'emai', 'system_helper', 'database']);
    }
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
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'usuario' => 'required|if_exist',
            ];

            $errors = [
                'email' => ['valid_email' => 'Email no existe, por favor verifique'],
                'usuario' => ['if_exist' => 'Usuario no existe, por favor verifique'],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $usuario = new UserModel();
                $email = new ContactoModel();
                $email->select()->asObject()
                    ->join('wk_contacto', 'wk_contacto.personaId = wk_persona.personaId')
                    ->where('tipoContactoId', $this->request->getVar('email'))
                    ->first();
                $user = $usuario->where('usuario', $this->request->getVar('usuario'))
                    ->first();
                $session = session();
                if ($user) {
                    $newReset = [
						'uuid' 		=> new_uuid(),
                        'ip_res'     => $this->request->getIPAddress(),
                        'email'     => $user['email'],
                        'usuario'     => $user['usuario'],
                    ];
                    $rmodel = new ResetsModel();
                    $rmodel->insert($newReset);

                    /**
                     * [Para que funcione el envío de email, es necesario configurar previamente el archivo app/Config/Email.php, y establecer
                     * el correo, contraseña, el método de envio, el puerto utilizado etc.,]
                     * 
                     * $protocol (si vas a usar gmail puede ser smtp, si usas un hosting propio, funciona mejor sendmail)
                     * $SMTPHost (el dominio que corresponda, por ejemplo smtp.example.com)
                     * $SMTPUser (tu correo que usarás para enviar ejemplo noreply@example.com)
                     * $SMTPPass (la contraseña del correo que usarás para enviar)
                     * $SMTPPort (el puerto que uses por smtp por default es 465)
                     * $SMTPCrypto (el tipo de encriptación ssl, tls)
                     * $mailType (sugiero html, para que puedas darle formato al correo)
                     * 
                     * @var string
                     */
                    $message     = 'Correspondencia UCAD<br>Soporte Técnico<br><hr>Su nueva contraseña es:
                    <br> 123456.';
                    $email         = \Config\Services::email();
                    $email->setFrom('avelarjr77@gmail.cm', 'Reestablecer accesos');
                    $email->setTo($newReset['email']);
                    $email->setSubject('Reestablecer accesos');
                    $email->setMessage($message);
                    if ($email->send()) {
                        $session->setFlashdata('success', 'Se ha enviado un enlace al correo electrónico');
                    } else {
                        $session->setFlashdata('danger', 'Error en el envío, por favor intenta más tarde.');
                    }
                } else {
                    $session->setFlashdata('danger', 'El email no se encontró, por favor verifique.');
                }
            }
        }
        return view('Login', $data);
    }
}
