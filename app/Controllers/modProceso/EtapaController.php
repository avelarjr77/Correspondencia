<?php namespace App\Controllers\modProceso;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modProceso\EtapaModel;
use App\Models\modProceso\ProcesoModel;
use App\Models\modAdministracion\MovimientosModel;

class EtapaController extends BaseController{

    //LISTAR PROCESO

    public function etapa(){

        $nombreEtapa= new EtapaModel();
        $procesoId  = $this->request->getVar('procesoId');
        $datos      = $nombreEtapa->listarEtapa($procesoId);

        echo json_encode($datos);
    }

    public function etapaC(){

        $nombreEtapa= new EtapaModel();
        $procesoId  = $this->request->getVar('procesoId');
        $datos      = $nombreEtapa->listarEtapaC($procesoId);

        echo json_encode($datos);
    }

    //list
    public function etapaList(){

        $nombreEtapa= new EtapaModel();
        $procesoId  = $this->request->getVar('procesoId');
        $datos      = $nombreEtapa->listarEtapa($procesoId);

        echo json_encode($datos);
    }


    //CREAR PROCESO
    public function crear(){

        $etapa = new EtapaModel();

        $nombreEtapa    = $this->request->getVar('nombreEtapa');
        $orden          = $this->request->getVar('orden');
        $procesoId      = $this->request->getVar('procesoId');

        $datos = [
            "nombreEtapa" => $nombreEtapa,
            "orden" => $orden,
            "procesoId" => $procesoId
        ];

        $proceso = new ProcesoModel();

        $nombreProceso  = $proceso->asArray()->select("nombreProceso")
        ->where("procesoId", $procesoId)->first();

        //PARA REGISTRAR EN BITACORA QUIEN CREÓ ETAPA
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó configuración de Etapa',
            'descripcion'   => $nombreProceso['nombreProceso'].': '.$nombreEtapa,
            'hora'          => $hora,
        ]);
        //END

        $respuesta = $etapa->insertar($datos);
        
        if ($respuesta > 0) {

            //$respuesta = $etapa->insertar($datos);
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

        $nombreEtapa = $etapa->asArray()->select("nombreEtapa")
        ->where("etapaId", $etapaId)->first();

        $respuesta = $etapa->eliminar($data);

        if ($respuesta > 0){
            //PARA REGISTRAR EN BITACORA QUIEN ELIMINÓ ETAPA
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó configuración de etapa',
                'descripcion'   => $nombreEtapa,
                'hora'          => $hora,
            ]);
            //END
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

        $proceso = new ProcesoModel();

        $respuesta = $etapa->actualizar($datos, $etapaId);

        $nombreProceso  = $proceso->asArray()->select("nombreProceso")
        ->where("procesoId", $procesoId)->first();

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ ETAPA
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó configuración de etapa',
            'descripcion'   => $nombreProceso['nombreProceso'].': '.$nombreEtapa,
            'hora'          => $hora,
        ]);
        //END

        if ($respuesta){
            $mensaje = 10;
        } else {
            $mensaje = 11;
        }

        echo json_encode($mensaje);
    }
}

?>
