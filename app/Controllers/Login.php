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
    public function __construct(){
		helper(['url', 'session', 'emai', 'upload', 'system_helper', 'database']);
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
                'email' => 'required|min_length[6]|max_length[50]|valid_email[wk_contacto.contacto]',
            ];

            $errors = [
                'email' => ['valid_email' => 'Email no existe, por favor verifique'],
            ];

            if (! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new ContactoModel();
                $user = $model->where('contacto', $this->request->getVar('email'))
                    ->first();
                $session = session();
                $pass = new UsuarioModel();
                    $clave = $pass->select('clave')->where('usuario', $session->usuario)
                    ->first();
                if ($user) {
                    $newReset = [
						'uuid' 		=> new_uuid(),
						'ip_res' 	=> $this->request->getIPAddress(),
						'email' 	=> $user['contacto'],
                        'clave' 	=> $clave,
					];
					$rmodel = new ResetsModel();
					$rmodel->insert($newReset);

                    $message     = 'Correspondencia UCAD<br>Soporte Técnico<br><hr>Su contraseña es:
                    <br>'. $clave['clave'];
                    $email         = \Config\Services::email();
                    $email->setFrom('correspondencia-ucad@gmail.com', 'Recuperar Contraseña');
                    $email->setTo( $user['contacto']);
                    $email->setSubject('Recuperar Contraseña');
                    $email->setMessage($message);
                    if ($email->send()) {
                        $session->setFlashdata('success', 'Se ha enviado un correo electrónico para recordar la contraseña');
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
