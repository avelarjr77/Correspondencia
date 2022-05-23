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

    public function etapaC(){

        $nombreEtapa = new EtapaModel();
        $procesoId = $this->request->getVar('procesoId');
        $datos = $nombreEtapa->listarEtapaC($procesoId);
        
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

        $etapa = new EtapaModel();

        $nombreEtapa = $this->request->getVar('nombreEtapa');
        $orden = $this->request->getVar('orden');
        $procesoId = $this->request->getVar('procesoId');

        $datos = [
            "nombreEtapa" => $nombreEtapa,
            "orden" => $orden,
            "procesoId" => $procesoId
        ];

        $respuesta = $etapa->insertar($datos);

        if ($respuesta > 0){
            $mensaje = 6;
        } else {
            $mensaje = 7;
        }

        echo json_encode($mensaje); 
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $etapa = new EtapaModel();

        $etapaId = $this->request->getVar('etapaId');

        $data = ["etapaId" => $etapaId];

        $respuesta = $etapa->eliminar($data);

        if ($respuesta > 0){
            $mensaje = 8;
        } else {
            $mensaje = 9;
        }

        echo json_encode($mensaje);
    }

    //ELIMINAR PROCESO
    public function actualizar()
    {
        $etapa = new EtapaModel();

        $etapaId = $this->request->getVar('etapaId');
        $nombreEtapa = $this->request->getVar('nombreEtapa');
        $orden = $this->request->getVar('orden');
        $procesoId = $this->request->getVar('procesoId');

        $datos = [
            "nombreEtapa" => $nombreEtapa,
            "orden" => $orden,
            "procesoId" => $procesoId
        ];

        $etapaId = $etapaId;

        $respuesta = $etapa->actualizar($datos, $etapaId);

        $datos = ["datos" => $respuesta];

        if ($respuesta){
            $mensaje = 10;
        } else {
            $mensaje = 11;
        }

        echo json_encode($mensaje);
    }
}

?>