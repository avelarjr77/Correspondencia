<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\TipoEnvioModel;

class TipoEnvioController extends BaseController{

    //LISTAR TIPO ENVIO

    public function tipoEnvio(){

        $tipoEnvio = new TipoEnvioModel();

        $mensaje = session('mensaje');

        $data = [
            'datos'=>$tipoEnvio->select("tipoEnvioId,tipoEnvio")->asObject()->findAll(),
            'mensaje' => $mensaje
        ];

        return view('modUsuario/tipoEnvio',$data);
        }

    //CREAR TIPO ENVIO
    public function crear(){

        $tipoEnvio = new TipoEnvioModel();

        if($this->validate('validarTipoEnvio')){
            $tipoEnvio->insert(
                [
                    "tipoEnvio" => $_POST['tipoEnvio']
                ]
            );

            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','1');
    } 

    //ELIMINAR TIPO DE ENVIO
    public function eliminar(){

        $tipoEnvioId = $_POST['tipoEnvioId'];
        $tipoEnvio = new TipoEnvioModel();

        $data = [
            "tipoEnvioId" => $tipoEnvioId
        ];

        $respuesta = $tipoEnvio->delete($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $tipoEnvio = new TipoEnvioModel();
        if ($this->validate([
            'tipoEnvio'        => 'is_unique[wk_tipo_envio.tipoEnvio]|alpha_space'
            ])) {
                $datos = [
                    "tipoEnvio" => $_POST['tipoEnvio']
                    
                ];

            $tipoEnvioId = $_POST['tipoEnvioId'];

            $respuesta = $tipoEnvio->actualizar($datos, $tipoEnvioId);

            $datos = ["datos" => $respuesta];
            
            return redirect()->to(base_url() . '/tipoEnvio')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/tipoEnvio')->with('mensaje', '5');
        }
    }
    
}

?>