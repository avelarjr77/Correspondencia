<?php

namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;
use App\Models\modUsuario\TipoContactoModel;

class ContactoController extends BaseController
{

    //LISTAR CONTACTOS

    public function contacto()
    {

        $contacto = new ContactoModel();
        $datos = $contacto->listarContacto();
        $persona = $contacto->listarPersona();
        $tipoContacto = $contacto->listarTipoContactos();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "contactos" => $contacto->select('contacto')->asObject()->findAll(),
            "persona" => $persona,
            "tipoContacto" => $tipoContacto,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/contacto', $data);
    }

    //CREAR CONTACTO
    public function crearContacto()
    {
        $contacto = new ContactoModel();
        if($this->validate('datosvacios')){
            $contacto->insertarContacto(
                [
                    "personaId" => $_POST['personaId'],
                    "tipoContactoId" => $_POST['tipoContactoId'],
                    "contacto" => $_POST['contacto'],
                    "estado" => $_POST['estado']
                ]
            );

            return redirect()->to(base_url(). '/contacto')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/contacto')->with('mensaje','6');
    }
    //CREAR TIPOCONTACT
    public function crearTipoContacto()
    {

        $tipoContacto = new ContactoModel();

        if($this->validate('validarContacto')){
            $tipoContacto->insertar(
                [
                    "tipoContacto" => $_POST['tipoContacto']
                ]
            );

            return redirect()->to(base_url(). '/contacto')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/contacto')->with('mensaje','1');
    }

    //ELIMINAR Contacto
    public function eliminarContacto()
    {

        $contactoId = $_POST['contactoId'];

        $contacto = new ContactoModel();
        $data = ["contactoId" => $contactoId];

        $respuesta = $contacto->eliminarContacto($data);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '3');
        }
    }
    //ELIMINAR TIPOCONTACTO
    public function eliminar()
    {

        $tipoContacto = $_POST['tipoContactoId'];

        $contacto = new ContactoModel();
        $data = ["tipoContactoId" => $tipoContacto];

        $respuesta = $contacto->eliminar($data);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '3');
        }
    }
    //ACTUALIZAR TIPOCONTACTO
    public function actualizar()
    {
        $tipoContacto = new ContactoModel();

        if ($this->validate([
            'tipoContacto'        => 'min_length[3]|max_length[20]|is_unique[wk_tipo_contacto.tipoContacto]|alpha_space'
            ])) {
                $datos = [
                    "tipoContacto"        => $_POST['tipoContacto']
                ];

            $tipoContactoId = $_POST['tipoContactoId'];
            $respuesta = $tipoContacto->actualizar($datos, $tipoContactoId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/contacto')->with('mensaje', '5');
        }

    }
    //ACTUALIZAR CONTACTO
    public function actualizarContacto()
    {
        $contacto = new ContactoModel();

        if ($this->validate([
            'estado'        => 'required'
            ])) {
                $datos = [
                    "tipoContactoId" => $_POST['tipoContactoId'],
                    "contacto" => $_POST['contacto'],
                    "estado" => $_POST['estado']
                ];

            $contactoId = $_POST['contactoId'];
            $respuesta = $contacto->actualizarContacto($datos, $contactoId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/contacto')->with('mensaje', '7');
        }
    }
}
