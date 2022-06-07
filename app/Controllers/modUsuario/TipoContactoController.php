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

    //CREAR TIPO CONTACTO
 /*   public function crearTipoContacto(){


        $tipoContacto = new TipoContactoModel();

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
    */

    //ELIMINAR 
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
        $tipoContacto = new TipoContactoModel();
        if ($this->validate([
            //'tipoContacto'        => 'min_length[3]|max_length[20]|alpha|is_unique[wk_tipo_contacto.tipoContacto]'
            ])) {
                $datos = [
                    "tipoContacto" => $_POST['tipoContacto']
                ];

            $tipoContactoId = $_POST['tipoContactoId'];
            $respuesta = $tipoContacto->actualizar($datos, $tipoContactoId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/contacto')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/contacto')->with('mensaje', '5');
        }
    }
    
}

?>