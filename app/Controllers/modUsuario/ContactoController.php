<?php

namespace App\Controllers\modUsuario;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modUsuario\ContactoModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modUsuario\TipoContactoModel;

class ContactoController extends BaseController
{

    //LISTAR CONTACTOS

    public function contacto()
    {

        $contacto       = new ContactoModel();
        $datos          = $contacto->listarContacto();
        $persona        = $contacto->listarPersona();
        $tipoContacto   = $contacto->listarTipoContactos();

        $mensaje = session('mensaje');

        $data = [
            "datos"         => $datos,
            "contactos"     => $contacto->select('contacto')->asObject()->findAll(),
            "persona"       => $persona,
            "tipoContacto"  => $tipoContacto,
            "mensaje"       => $mensaje
        ];

        return view('modUsuario/contacto', $data);
    }

    //CREAR CONTACTO
    public function crearContacto()
    {
        $contacto = new ContactoModel();
        $tipoContactoId = $_POST['tipoContactoId'];
        if($this->validate('datosvacios')){
            $contacto->insertarContacto(
                [
                    "personaId"      => $_POST['personaId'],
                    "tipoContactoId" => $_POST['tipoContactoId'],
                    "contacto"       => $_POST['contacto'],
                    "estado"         => $_POST['estado']
                ]
            );

            $tipoContacto = new TipoContactoModel();

            $nombreTipoContacto = $tipoContacto->asArray()->select("tipoContacto")
            ->where("tipoContactoId", $tipoContactoId)->first();

            $nombreContacto = $_POST['contacto'];

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL CONTACTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó contacto',
                'descripcion'   => $nombreTipoContacto['tipoContacto'] . ': ' . $_POST['contacto'],
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/contacto')->with('mensaje','0');
        }

            return redirect()->to(base_url(). '/contacto')->with('mensaje','6');
    }

    //ELIMINAR Contacto
    public function eliminarContacto()
    {

        $contactoId = $_POST['contactoId'];

        $contacto = new ContactoModel();
        $data = ["contactoId" => $contactoId];

        $nombreContacto = $contacto->asArray()->select("contacto")
        ->where("contactoId", $contactoId)->first();

        $respuesta = $contacto->eliminarContacto($data, $contactoId);

        if ($respuesta > 0) {

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO EL CONTACTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $session,
                'accion' => 'Eliminó contacto',
                'descripcion' => $nombreContacto,
                'hora' => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/contacto')->with('mensaje', '2');
        } else {
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '3');
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

            //PARA REGISTRAR EN BITACORA QUIEN EDITO EL CONTACTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $session,
                'accion' => 'Editó contacto',
                'descripcion' => $_POST['contacto'],
                'hora' => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/contacto')->with('mensaje', '7');
        }
    }
}
