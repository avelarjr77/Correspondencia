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
        return view('home', ["mensaje" => $mensaje]);
    }

    public function login()
    {
        //dd($this->request->getPost());
        $usuario = trim($this->request->getVar('usuario'));
        $clave = $this->request->getVar('clave');

        $usuarios = model('Usuarios');
        $pass = $usuarios->obtenerUsuario('clave', $clave);

        #Seleccionar el rolId de l usuario logueado
        /* $rolId = $this->db->query("SELECT rolId FROM wk_usuario WHERE usuario='Mar97' LIMIT 1");*/
<<<<<<< HEAD
        print_r($usuarios);

        if ($user = $usuarios->obtenerUsuario('usuario', $usuario) && isset($pass['clave'])) {
=======
        print_r($usuarios); 

        if($user=$usuarios->obtenerUsuario('usuario',$usuario) && isset($pass['clave'])){
>>>>>>> 6e7b0dce91127995cfa0abb597c8d1eb3fdcb587

            $data = array(
                'usuario' => $usuario,
                'is_logged' => true
            );

            $session = session();
            $session->set($data);

<<<<<<< HEAD
            return redirect()->to(base_url('/home'))->with('mensaje', '0');
        } else {
            return redirect()->to(base_url('/'))->with('mensaje', '1');
=======
            return redirect()->to(base_url('/home'))->with('mensaje','0');

        }else{
            return redirect()->to(base_url('/'))->with('mensaje','1');
>>>>>>> 6e7b0dce91127995cfa0abb597c8d1eb3fdcb587
        }
    }

    public function modulo()
    {
        $modulo = new RolModMenuModel();
        $datos = $modulo->listarModulos();
        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje"   => $mensaje
        ];

        return view('home', $data);
    }

    public function salir()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('/'));
    }
}
