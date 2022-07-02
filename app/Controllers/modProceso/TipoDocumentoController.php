<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\TipoDocumentoModel;

class TipoDocumentoController extends BaseController{

    //LISTAR TIPO DOCUMENTO

    public function tipoDocumento(){

        $nombreTipoDocumento = new TipoDocumentoModel();
        $datos = $nombreTipoDocumento->listarTipoDocumento();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modProceso/tipoDocumento', $data);
    }

    //CREAR TIPO DOCUMENTO
    public function crear(){

        $datos = [
            "tipoDocumento" => $_POST['tipoDocumento']
        ];

        $tipoDocumento = new TipoDocumentoModel();
        $respuesta = $tipoDocumento->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/tipoDocumento')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/tipoDocumento')->with('mensaje','1');
        } 
    } 

    //ELIMINAR TIPO DOCUMENTO
    public function eliminar(){

        $tipoDocumentoId = $_POST['tipoDocumentoId'];

        $tipoDocumento = new TipoDocumentoModel();
        $data = ["tipoDocumentoId" => $tipoDocumentoId];

        $respuesta = $tipoDocumento->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/tipoDocumento')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/tipoDocumento')->with('mensaje','3');
        }
    }

    //EDITAR TIPO DOCUMENTO
    public function actualizar()
    {
        $datos = [
            "tipoDocumento" => $_POST['tipoDocumento']
        ];

        $tipoDocumentoId = $_POST['tipoDocumentoId'];

        $tipoDocumento = new TipoDocumentoModel();
        $respuesta = $tipoDocumento->actualizar($datos, $tipoDocumentoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/tipoDocumento')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/tipoDocumento')->with('mensaje', '5');
        }
    }
    
}

?>