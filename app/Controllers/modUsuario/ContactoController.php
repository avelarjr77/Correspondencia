<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;

class ContactoController extends BaseController{

    //LISTAR ROLES

    public function contacto(){

        $nombreDepartamento = new ContactoModel();
        $datos = $nombreDepartamento->listarContactos();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
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

        $departamentoId = $_POST['contactoId'];

        $departamento = new ContactoModel();
        $data = ["contactoId" => $departamentoId];

        $respuesta = $departamento->eliminar($data);

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

        $departamentoId = $_POST['contactoId'];

        $departamento = new ContactoModel();
        $respuesta = $departamento->actualizar($datos, $departamentoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '5');
        }
    }
    
}

?>