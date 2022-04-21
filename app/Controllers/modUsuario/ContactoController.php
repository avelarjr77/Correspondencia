<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\TipoContactoModel;

class ContactoController extends BaseController{

    //LISTAR ROLES

        //LISTAR Contactos

    public function contacto(){

        $contacto = new ContactoModel();
        $datos = $contacto->listarContacto();
        $persona = $contacto->listarPersona();
        $tipoContacto = $contacto->listarTipoContactos();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "persona" => $persona,
            "tipoContacto" => $tipoContacto,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/contacto', $data);
        }

    //CREAR ROLES
    public function crear(){

        $datos = [
            "tipoContacto" => $_POST['tipoContacto']
        ];

        $tipoContacto = new ContactoModel();
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

        $contacto = new ContactoModel();
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

        $tipoContacto = new ContactoModel();
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