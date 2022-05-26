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
<<<<<<< Updated upstream
        $pass=$usuarios->obtenerUsuario('clave',$clave);

        if(!$user=$usuarios->obtenerUsuario('usuario',$usuario)){

            return redirect()->to(base_url('/'))->with('mensaje','0');

=======
        $pass = $usuarios->obtenerUsuario('clave', $clave);

        #Seleccionar el rolId de l usuario logueado
        /* $rolId = $this->db->query("SELECT rolId FROM wk_usuario WHERE usuario='Mar97' LIMIT 1");*/

        print_r($usuarios);

        if ($user = $usuarios->obtenerUsuario('usuario', $usuario) && isset($pass['clave'])) {

            print_r($usuarios);

            if ($user = $usuarios->obtenerUsuario('usuario', $usuario) && isset($pass['clave'])) {

                $data = array(
                    'usuario' => $usuario,
                    'is_logged' => true
                );

                $session = session();
                $session->set($data);

                return redirect()->to(base_url('/home'))->with('mensaje', '0');
            } else {
                return redirect()->to(base_url('/'))->with('mensaje', '1');
            }
>>>>>>> Stashed changes
        }

        if(isset($pass['clave'])){

            return redirect()->to(base_url('/home'))->with('mensaje','1');

        } else{
            return redirect()->to(base_url('/'))->with('mensaje','2');
        }

     }  
}
<<<<<<< Updated upstream

?>
=======
>>>>>>> Stashed changes
