<?php namespace App\Controllers\modProceso;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modProceso\TipoDocumentoModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modUsuario\DocumentoModel;

class TipoDocumentoController extends BaseController{

    //LISTAR TIPO DOCUMENTO

    public function tipoDocumento(){

        $nombreTipoDocumento = new TipoDocumentoModel();
        $datos = $nombreTipoDocumento->listarTipoDocumento();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modProceso/tipoDocumento', $data);
    }

    //CREAR TIPO DOCUMENTO
    public function crear(){

        $datos = [
            "tipoDocumento" => $_POST['tipoDocumento']
        ];

        //PARA REGISTRAR EN BITACORA QUIEN CREÓ TIPO DOCUMENTO
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó tipo de documento',
            'descripcion'   => $_POST['tipoDocumento'],
            'hora'          => $hora,
        ]);

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
        $documento = new DocumentoModel();
        $data = ["tipoDocumentoId" => $tipoDocumentoId];

        $nombreDocumento = $tipoDocumento->asArray()->select("tipoDocumento")
        ->where("tipoDocumentoId", $tipoDocumentoId)->first();

        //Para buscar si el Tipo de documento está relacionado
        $buscarRelacion = $documento->select('tipoDocumentoId')->where('tipoDocumentoId', $tipoDocumentoId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/tipoDocumento')->with('mensaje', '6');
        }

        $respuesta = $tipoDocumento->eliminar($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINÓ TIPO DOCUMENTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó tipo de documento',
                'descripcion'   => $nombreDocumento,
                'hora'          => $hora,
            ]);
            //END

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

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ TIPO DOCUMENTO
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó tipo de documento',
            'descripcion'   => $_POST['tipoDocumento'],
            'hora'          => $hora,
        ]);

        if ($respuesta) {
            return redirect()->to(base_url() . '/tipoDocumento')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/tipoDocumento')->with('mensaje', '5');
        }
    }
    
}

?>