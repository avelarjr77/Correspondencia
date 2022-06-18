<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\UsuarioModel;

class UsuarioController extends BaseController{

    //LISTAR USUARIO

    public function usuario(){

        $nombreUsuario = new UsuarioModel();
        $datos = $nombreUsuario->listarUsuario();
        $persona = $nombreUsuario->listarPersona();
        $rol = $nombreUsuario->listarRol();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "persona" => $persona,
            "rol" => $rol,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/usuario', $data);
        }

    //CREAR USUARIO
    public function crear(){

        $usuario = new UsuarioModel();

        if($this->validate('validarUsuario')){
            $usuario->insertar(
                [
                    "personaId" => $_POST['personaId'],
                    "usuario" => $_POST['usuario'],
                    "clave" => $_POST['clave'],
                    "estado" => $_POST['estado'],
                    "rolId" => $_POST['rolId']
                ]
            );

            return redirect()->to(base_url(). '/usuario')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/usuario')->with('mensaje','1');
    } 

    //ELIMINAR USUARIO
    public function eliminar(){

        $usuarioId = $_POST['usuarioId'];

        $usuario = new UsuarioModel();
        $data = ["usuarioId" => $usuarioId];

        $respuesta = $usuario->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/usuario')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/usuario')->with('mensaje','3');
        }
    }

    //ACTUALIZAR USUARIO
    public function actualizar()
    {
        $usuario = new UsuarioModel();
        if ($this->validate([
            'usuario'        => 'is_unique[wk_usuario.usuario]|alpha_numeric'
            ])) {
                $datos = [
                    "personaId" => $_POST['personaId'],
                    "usuario" => $_POST['usuario'],
                    "clave" => $_POST['clave'],
                    "estado" => $_POST['estado'],
                    "rolId" => $_POST['rolId']
                ];

            $usuarioId = $_POST['usuarioId'];
            
            $respuesta = $usuario->actualizar($datos, $usuarioId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/usuario')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/usuario')->with('mensaje', '5');
        } 
    }
    
}

?>