<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\ActividadModel;

class ActividadController extends BaseController{

    //LISTAR ACTIVIDAD

    public function actividad(){

        $nombreActividad = new ActividadModel();

        $etapaId = $this->request->getVar('etapaId');

        $datos = $nombreActividad->listarActividad($etapaId);

        echo json_encode($datos);
    }

    //list
    public function actList(){

        $nombreActividad = new ActividadModel();

        $etapaId = $this->request->getVar('etapaId');

        $datos = $nombreActividad->listarActividad($etapaId);

        echo json_encode($datos);
    }

    public function personaList(){

        $actividad = new ActividadModel();

        $datos = $actividad->listarPersona();

        echo json_encode($datos);
    }

    public function personaListA(){

        $actividad = new ActividadModel();

        $datos = $actividad->listarPersona();

        echo json_encode($datos);
    }

    public function etapaL(){

        $etapa = new ActividadModel();

        $etapaId = $this->request->getVar('etapaId');

        $datos = $etapa->etapaL($etapaId);

        echo json_encode($datos);
    }

    //CREAR ACTIVIDAD
    public function crear(){

        $actividad = new ActividadModel();

        $etapaId = $this->request->getVar('etapaId');
        $nombreActividad = $this->request->getVar('nombreActividad');
        $descripcion = $this->request->getVar('descripcion');
        $personaId = $this->request->getVar('personaId');

        $datos = [
            "nombreActividad" => $nombreActividad,
            "descripcion" => $descripcion,
            "etapaId" => $etapaId,
            "personaId" => $personaId
        ];

        $respuesta = $actividad->insertar($datos);

        if ($respuesta){
            $mensaje = 12;
        } else {
            $mensaje = 13;
        }

        echo json_encode($mensaje);
    } 

    //ELIMINAR ACTIVIDAD
    public function eliminar(){

        $actividad = new ActividadModel();

        $actividadId = $this->request->getVar('actividadId');

        $data = ["actividadId" => $actividadId];

        $respuesta = $actividad->eliminar($data);

        if ($respuesta > 0){
            $mensaje = 14;
        } else {
            $mensaje = 15;
        }

        echo json_encode($mensaje);
    }

    //ELIMINAR ACTIVIDAD
    public function actualizar()
    {
        $actividad = new ActividadModel();

        $actividadId = $this->request->getVar('actividadId');
        $etapaId = $this->request->getVar('etapaId');
        $nombreActividad = $this->request->getVar('nombreActividad');
        $descripcion = $this->request->getVar('descripcion');
        $personaId = $this->request->getVar('personaId');

        $datos = [
            "nombreActividad" => $nombreActividad,
            "descripcion" => $descripcion,
            "etapaId" => $etapaId,
            "personaId" => $personaId
        ];

        $respuesta = $actividad->actualizar($datos, $actividadId);

        $datos = ["datos" => $respuesta];

        if ($respuesta){
            $mensaje = 16;
        } else {
            $mensaje = 17;
        }

        echo json_encode($mensaje);
    }
    
}

?>