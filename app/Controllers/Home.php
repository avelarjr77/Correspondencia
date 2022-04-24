<?php  namespace App\Controllers;

use App\Models\Usuarios;

class Home extends BaseController
{
    public function index()
    {
        $mensaje = session('mensaje');
        return view('home',["mensaje"=> $mensaje]);
    }

    public function login(){
        //dd($this->request->getPost());
        $usuario = trim($this->request->getVar('usuario'));
        $clave = $this->request->getVar('clave');

        $usuarios = model('Usuarios');
        $pass=$usuarios->obtenerUsuario('clave',$clave);

        if(!$user=$usuarios->obtenerUsuario('usuario',$usuario)){

            return redirect()->to(base_url('/'))->with('mensaje','0');

        }

        if(isset($pass['clave'])){

            return redirect()->to(base_url('/home'))->with('mensaje','1');

        } else{
            return redirect()->to(base_url('/'))->with('mensaje','2');
        }

     }  
}

?>