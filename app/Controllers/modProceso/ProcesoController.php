<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\ProcesoModel;

class ProcesoController extends BaseController{

    //LISTAR PROCESO

    public function proceso(){

        $nombreProceso = new ProcesoModel();
        $datos = $nombreProceso->listarProceso();
        $tipoProceso = $nombreProceso->listarTipoProceso();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "tipoProceso" => $tipoProceso,
            "mensaje" => $mensaje
        ];

        return view('modProceso/proceso', $data);
    }

    //CREAR PROCESO
    public function crear(){
        
        $proceso = new ProcesoModel();
        if($this->validate('validarProceso')){
            $proceso->insertar(
                [
                    "nombreProceso" => $_POST['nombreProceso'],
                    "tipoProcesoId" => $_POST['tipoProcesoId']
                ]
            );

            return redirect()->to(base_url(). '/proceso')->with('mensaje','0');
        }

            return redirect()->to(base_url(). '/proceso')->with('mensaje','6');
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $procesoId = $_POST['procesoId'];

        $proceso = new ProcesoModel();
        $data = ["procesoId" => $procesoId];

        $respuesta = $proceso->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/proceso')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/proceso')->with('mensaje','3');
        }
    }

    //ELIMINAR PROCESO
    public function actualizar()
    {
        $datos = [
            "nombreProceso" => $_POST['nombreProceso'],
            "tipoProcesoId" => $_POST['tipoProcesoId']
        ];

        $procesoId = $_POST['procesoId'];

        $proceso = new ProcesoModel();
        $respuesta = $proceso->actualizar($datos, $procesoId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '5');
        }
    }
    
}

?>