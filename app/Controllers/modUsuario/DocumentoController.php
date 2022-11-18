<?php namespace App\Controllers\modUsuario;

use App\Controllers\BaseController;
use App\Models\modUsuario\DocumentoModel;
use CodeIgniter\I18n\Time;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modTransaccion\TransaccionActividadModel;

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
                    "tipoDocumentoId" => $_POST['tipoDocumentoId'],
                    "tipoEnvioId" => $_POST['tipoEnvioId'],
                    "transaccionActividadId" => $_POST['transaccionActividadId']
                ]
            );
            $this->_upload();

            return redirect()->to(base_url(). '/documento')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/documento')->with('mensaje','1');

    } 
    
    public function crearImage(){

        $nombreDocumento = $this->request->getVar('nombreDocumento');
        $tipoDocumentoId = $this->request->getVar('tipoDocumentoId');
        $tipoEnvioId = $this->request->getVar('tipoEnvioId');
        $transaccionActividadId = $this->request->getVar('transaccionActividadId');

        $transaccion = new TransaccionActividadModel();
        $etapaId =  $transaccion->asArray()->select('td.etapaId')
        ->from('wk_transaccion_actividades ta')
        ->join('wk_transaccion_detalle td', 'ta.transaccionDetalleId = td.transaccionDetalleId')
        ->where('ta.transaccionActividadId', $transaccionActividadId)->first(); 
        
        $etapa = $etapaId['etapaId'];

        $file=$_FILES["nombreDocumento"];

        $fileName=$_FILES['nombreDocumento']['name'];
        $fileTmpName=$_FILES['nombreDocumento']['tmp_name'];
        $fileSize=$_FILES['nombreDocumento']['size'];
        $fileError=$_FILES['nombreDocumento']['error'];
        $fileType=$_FILES['nombreDocumento']['type'];

        $fileExt=explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png','pdf','docx', 'txt');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                
                // 20  MB de capacidad
                if ($fileSize < 20971520) { 

                    $fileDestination = 'uploads/'.$fileName;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    $nombreDoc = new DocumentoModel();

                    $datos = [
                        "nombreDocumento" => $fileName,
                        "tipoDocumentoId" => $tipoDocumentoId,
                        "tipoEnvioId" => $tipoEnvioId,
                        "transaccionActividadId" => $transaccionActividadId
                    ];
                    $respuesta = $nombreDoc->insertar($datos);

                    //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL DOCUMENTO
                    $this->bitacora  = new MovimientosModel();
                    $hora=new Time('now');
                    $session = session('usuario');

                    $this->bitacora->save([
                        'bitacoraId'    => null,
                        'usuario'       => $session,
                        'accion'        => 'Agregó un documento',
                        'descripcion'   => $_POST['tipoDocumentoId'].$_POST['tipoEnvioId'],
                        'hora'          => $hora,
                    ]);
                    //END     

                    if ($respuesta > 0 ) {
                        return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapa)->with('mensaje','0');
                    }else{
                        return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapa)->with('mensaje','8');
                    }

                } else {
                    return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapa)->with('mensaje','14');
                }
            } else {
                return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapa)->with('mensaje','0');
            }
        } else {
            return redirect()->to(base_url() . '/transaccionActividades?etapaId='.$etapa)->with('mensaje','7');
        }     
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

    //ELIMINAR DOCUMENTO - VISTA TRANSACCIÓN ACTIVIDAD
    public function eliminarDoc(){

        $documentoId = $_POST['documentoId'];
        $nombreDocumento = $_POST['nombreDocumento'];
        $transaccionActividadId = $_POST['transaccionActividadId'];

        $transaccion = new TransaccionActividadModel();
        $etapaId =  $transaccion->asArray()->select('td.etapaId')
        ->from('wk_transaccion_actividades ta')
        ->join('wk_transaccion_detalle td', 'ta.transaccionDetalleId = td.transaccionDetalleId')
        ->where('ta.transaccionActividadId', $transaccionActividadId)->first(); 
        $etapa = $etapaId['etapaId'];

        $documento = new DocumentoModel();
        $data = ["documentoId" => $documentoId];

        $respuesta = $documento->eliminar($data);

        array_map('unlink', glob("uploads/".$nombreDocumento));

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/transaccionActividades?etapaId='.$etapa)->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/transaccionActividades?etapaId='.$etapa)->with('mensaje','3');
        }
    }

    //ACTUALIZAR DOC
    public function actualizar()
    {
        $datos = [
            "nombreDocumento" => $_POST['nombreDocumento'],
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

    private function _upload(){
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $imagefile) {
                if ($imagefile->isValid() && ! $imagefile->hasMoved()) {
                    $newName = $imagefile->getRandomName();
                    $imagefile->move(WRITEPATH . 'uploads', $newName);
                }
            }
        }
    }

    public function listadoDocumentos(){

        $documento = new DocumentoModel();

        //$documentoId = $_POST['documentoId'];
        $transaccionActividadId = $_GET['transaccionActividadId'];

        $data = [
            "datos" => $documento->asObject()->select('d.documentoId, d.nombreDocumento, a.nombreActividad')
            ->from('wk_documento d')
            ->join('wk_transaccion_actividades ta', 'ta.transaccionActividadId = d.transaccionActividadId')
            ->join(' wk_actividad a', 'a.actividadId = ta.actividadId')
            ->where('ta.transaccionActividadId', $transaccionActividadId)
            ->groupBy('d.documentoId')
            ->findAll(),
        ];

        return view('modTransaccion/listadoDocumentos', $data);
    }
    
}

?>
