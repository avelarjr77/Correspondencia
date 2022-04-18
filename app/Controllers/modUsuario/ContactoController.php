<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;

class ContactoController extends BaseController{

    //LISTAR ROLES

    public function contacto(){

        $nombreContacto = new ContactoModel();
        $datos = $nombreContacto->listarContactos();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/contacto', $data);
        }

    //CREAR TIPO CONTACTO
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

    //ELIMINAR TIPO CONTACTO
    public function eliminar(){

        $contactoId = $_POST['contactoId'];

        $contacto = new ContactoModel();
        $data = ["contactoId" => $contactoId];

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
            "contacto" => $_POST['contacto']
        ];

        $contactoId = $_POST['contactoId'];

        $contacto = new ContactoModel();
        $respuesta = $contacto->actualizar($datos, $contactoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '5');
        }
    }
    
}

?>