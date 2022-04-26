<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\TipoProcesoModel;

class TipoProcesoController extends BaseController{

    //LISTAR PROCESO

    public function tipoProceso(){

        $nombreTipoProceso = new TipoProcesoModel();
        $datos = $nombreTipoProceso->listarTipoProceso();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modProceso/tipoProceso', $data);
        }

    //CREAR PROCESO
    public function crear(){

        $datos = [
            "tipoProceso" => $_POST['tipoProceso']
        ];

        $tipoProceso = new TipoProcesoModel();
        $respuesta = $tipoProceso->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','1');
        } 
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $tipoProcesoId = $_POST['tipoProcesoId'];

        $tipoProceso = new TipoProcesoModel();
        $data = ["tipoProcesoId" => $tipoProcesoId];

        $respuesta = $tipoProceso->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','3');
        }
    }

    //ELIMINAR PROCESO
    public function actualizar()
    {
        $datos = [
            "tipoProceso" => $_POST['tipoProceso']
        ];

        $tipoProcesoId = $_POST['tipoProcesoId'];

        $tipoProceso = new TipoProcesoModel();
        $respuesta = $tipoProceso->actualizar($datos, $tipoProcesoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/tipoProceso')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/tipoProceso')->with('mensaje', '5');
        }
    }
    
}

?>