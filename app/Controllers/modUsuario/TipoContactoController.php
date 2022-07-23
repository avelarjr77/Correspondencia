<?php namespace App\Controllers\modUsuario;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modUsuario\TipoContactoModel;
use App\Models\modAdministracion\MovimientosModel;

class TipoContactoController extends BaseController{

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

    //CREAR TIPO CONTACTO
    public function crearTipoContacto(){

        $tipoContacto = new TipoContactoModel();

        if($this->validate('validarContacto')){
            $tipoContacto->insertar(
                [
                    "tipoContacto" => $_POST['tipoContacto']
                ]
            );

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ LA TIPO CONTACTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó Tipo de contacto',
                'descripcion'   => $_POST['tipoContacto'],
                'hora'          => $hora,
            ]);
        //END

            return redirect()->to(base_url(). '/contacto')->with('mensaje','0');
        }

            return redirect()->to(base_url(). '/contacto')->with('mensaje','1');
    }

    //ELIMINAR
    public function eliminar(){

        $tipoContactoId = $_POST['tipoContactoId'];

        $contacto = new TipoContactoModel();
        $data = ["tipoContactoId" => $tipoContactoId];

        $nombreTipoContacto = $contacto->asArray()->select("tipoContacto")
        ->where("tipoContactoId", $tipoContactoId)->first();

        $respuesta = $contacto->eliminar($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO TIPO DE CONTACTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó Tipo de contacto',
                'descripcion'   => $nombreTipoContacto,
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/contacto')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/contacto')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $tipoContacto = new TipoContactoModel();

        if ($this->validate([
            'tipoContacto'        => 'min_length[3]|max_length[20]|is_unique[wk_tipo_contacto.tipoContacto]|alpha_space'
            ])) {
                $datos = [
                    "tipoContacto"        => $_POST['tipoContacto']
                ];

            $tipoContactoId = $_POST['tipoContactoId'];
            $respuesta = $tipoContacto->actualizar($datos, $tipoContactoId);

            $datos = ["datos" => $respuesta];

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ TIPO CONTACTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Editó Tipo de contacto',
                'descripcion'   => $_POST['tipoContacto'],
                'hora'          => $hora,
            ]);
        //END

            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/contacto')->with('mensaje', '5');
        }
    }
    
}

?>