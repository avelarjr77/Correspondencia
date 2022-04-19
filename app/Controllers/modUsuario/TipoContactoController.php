<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\TipoContactoModel;

class ContactoController extends BaseController{

    //LISTAR ROLES

    public function tipoContacto(){

        $nombreTipoContacto = new TipoContactoModel();
        $datos = $nombreTipoContacto->listarTipoContactos();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/contacto', $data);
        }

    //CREAR ROLES
    public function crearTipoContacto(){

        $datos = [
            "tipoContacto" => $_POST['tipoContacto']
        ];

        $tipoContacto = new TipoContactoModel();
        $respuesta = $tipoContacto->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/contacto')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/contacto')->with('mensaje','1');
        } 
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $tipoContacto = $_POST['tipoContactoId'];

        $contacto = new TipoContactoModel();
        $data = ["tipoContactoId" => $tipoContacto];

        $respuesta = $contacto->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/contacto')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/contacto')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $datos = [
            "tipoContacto" => $_POST['tipoContacto']
        ];

        $tipoContactoId = $_POST['tipoContactoId'];

        $tipoContacto = new TipoContactoModel();
        $respuesta = $tipoContacto->actualizar($datos, $tipoContactoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '5');
        }
    }
    
}

?>