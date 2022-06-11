<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\DocumentoModel;

class DocumentoController extends BaseController{

    //LISTAR DOCUMENTO

    public function documento(){

        $nombreDocumento = new DocumentoModel();
        $datos = $nombreDocumento->listarDocumento();
        $tipoDocumento = $nombreDocumento->listarTipoDocumento();
        $tipoEnvio = $nombreDocumento->listarTipoEnvio();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "tipoDocumento" => $tipoDocumento,
            "tipoEnvio" => $tipoEnvio,
            "mensaje" => $mensaje
        ];

        return view('modUsuario/documento', $data);
        }

    //CREAR Documento
    public function crear(){

        $nombreDocumento = new DocumentoModel();
        if($this->validate('validarDocumento')){
            $nombreDocumento->insertar(
                [
                    "nombreDocumento" => $_POST['nombreDocumento'],
                    "documento" => $_POST['documento'],
                    "tipoDocumentoId" => $_POST['tipoDocumentoId'],
                    "tipoEnvioId" => $_POST['tipoEnvioId'],
                    "transaccionActividadId" => $_POST['transaccionActividadId']
                ]
            );

            return redirect()->to(base_url(). '/documento')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/documento')->with('mensaje','1');

    } 

    //ELIMINAR DOCUMENTO
    public function eliminar(){

        $documentoId = $_POST['documentoId'];

        $documento = new DocumentoModel();
        $data = ["documentoId" => $documentoId];

        $respuesta = $documento->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/documento')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/documento')->with('mensaje','3');
        }
    }

    //ACTUALIZAR PERSONA
    public function actualizar()
    {
        $datos = [
            "nombreDocumento" => $_POST['nombreDocumento'],
            "documento" => $_POST['documento'],
            "tipoDocumentoId" => $_POST['tipoDocumentoId'],
            "tipoEnvioId" => $_POST['tipoEnvioId'],
            "transaccionActividadId" => $_POST['transaccionActividadId']
        ];

        $documentoId = $_POST['documentoId'];

        $actualizarDoc = new DocumentoModel();
        $respuesta = $actualizarDoc->actualizar($datos, $documentoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/documento')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/documento')->with('mensaje', '5');
        }
    }
    
}

?>