<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('isLoggedIn')){
            return redirect()->to('/');
        } 

        $usuarios = model('Usuarios');
        if(!$user=$usuarios->obtenerUsuario('usuario', session()->usuarioId)){

            $data = array(
                'usuario' => $usuario
            );
                
            $session = session();
            $session->destroy();

            return redirect()->to(base_url('/Login'))->with('mensaje','0');

        }
        dd($user);

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}