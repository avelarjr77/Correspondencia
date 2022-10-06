<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\EtapaModel;

class EtapaController extends BaseController{

    //LISTAR PROCESO

    public function etapa(){

        $nombreEtapa = new EtapaModel();
        $procesoId = $this->request->getVar('procesoId');
        $datos = $nombreEtapa->listarEtapa($procesoId);
       
        echo json_encode($datos);
    }

    //list
    public function etapaList(){

        $nombreEtapa = new EtapaModel();
        $procesoId = $this->request->getVar('procesoId');
        $datos = $nombreEtapa->listarEtapa($procesoId);

        echo json_encode($datos);
    }


    //CREAR PROCESO
    public function crear(){

        $datos = [
            "nombreEtapa" => $_POST['nombreEtapa'],
            "orden" => $_POST['orden'],
            "procesoId" => $_POST['procesoId']
        ];

        $etapa = new EtapaModel();
        $respuesta = $etapa->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/proceso')->with('mensaje','6');
        } else {
            return redirect()->to(base_url(). '/proceso')->with('mensaje','7');
        } 
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $etapaId = $_POST['etapaId'];

        $etapa = new EtapaModel();
        $data = ["etapaId" => $etapaId];

        $respuesta = $etapa->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/proceso')->with('mensaje','8');
        } else {
            return redirect()->to(base_url(). '/proceso')->with('mensaje','9');
        }
    }

    //ELIMINAR PROCESO
    public function actualizar()
    {
        $datos = [
            "nombreEtapa" => $_POST['nombreEtapa'],
            "orden" => $_POST['orden'],
            "procesoId" => $_POST['procesoId']
        ];

        $etapaId = $_POST['etapaId'];

        $etapa = new EtapaModel();
        $respuesta = $etapa->actualizar($datos, $etapaId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '10');
        } else {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '11');
        }
    }
    
}

?>