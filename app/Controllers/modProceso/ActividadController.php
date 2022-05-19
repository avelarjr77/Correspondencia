<?php namespace App\Controllers\modProceso;

use App\Controllers\BaseController;
use App\Models\modProceso\ActividadModel;

class ActividadController extends BaseController{

    //LISTAR PROCESO

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

    //CREAR PROCESO
    public function crear(){

        $datos = [
            "nombreActividad" => $_POST['nombreActividad'],
            "descripcion" => $_POST['descripcion'],
            "etapaId" => $_POST['etapaId'],
            "personaId" => $_POST['personaId']
        ];

        $actividad = new ActividadModel();
        $respuesta = $actividad->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/proceso')->with('mensaje','12');
        } else {
            return redirect()->to(base_url(). '/proceso')->with('mensaje','13');
        } 
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $actividadId = $_POST['actividadId'];

        $actividad = new ActividadModel();
        $data = ["actividadId" => $actividadId];

        $respuesta = $actividad->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/proceso')->with('mensaje','14');
        } else {
            return redirect()->to(base_url(). '/proceso')->with('mensaje','15');
        }
    }

    //ELIMINAR PROCESO
    public function actualizar()
    {
        $datos = [
            "nombreActividad" => $_POST['nombreActividad'],
            "descripcion" => $_POST['descripcion'],
            "etapaId" => $_POST['etapaId'],
            "personaId" => $_POST['personaId']
        ];

        $actividadId = $_POST['actividadId'];

        $actividad = new ActividadModel();
        $respuesta = $actividad->actualizar($datos, $actividadId);

        $datos = ["datos" => $respuesta];

        if ($respuesta) {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '16');
        } else {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '17');
        }
    }
    
}

?>