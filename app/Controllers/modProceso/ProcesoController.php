<?php namespace App\Controllers\modProceso;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modProceso\ProcesoModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modProceso\ActividadModel;
use App\Models\modTransaccion\TransaccionModel;

class ProcesoController extends BaseController{

    //LISTAR PROCESO

    public function proceso(){

        $nombreProceso  = new ProcesoModel();
        $datos          = $nombreProceso->listarProceso();
        $tipoProceso    = $nombreProceso->listarTipoProceso();

        $mensaje = session('mensaje');

        $data = [
            "datos"         => $datos,
            "tipoProceso"   => $tipoProceso,
            "mensaje"       => $mensaje
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

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL PROCESO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó configuración de proceso',
                'descripcion'   => $_POST['nombreProceso'],
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/proceso')->with('mensaje','0');
        }

            return redirect()->to(base_url(). '/proceso')->with('mensaje','6');
    } 

    //ELIMINAR PROCESO
    public function eliminar(){

        $procesoId = $_POST['procesoId'];

        $proceso = new ProcesoModel();
        $transaccion = new TransaccionModel();
        $data = ["procesoId" => $procesoId];

        $nombreProceso = $proceso->asArray()->select("nombreProceso")
        ->where("procesoId", $procesoId)->first();

        //Para buscar si el Proceso está relacionado
        $buscarRelacion = $transaccion->select('procesoId')->where('procesoId', $procesoId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '7');
        }

        $respuesta = $proceso->eliminar($data);

        if ($respuesta > 0){
$
            //PARA REGISTRAR EN BITACORA QUIEN ELIMINÓ EL PROCESO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó configuración de proceso',
                'descripcion'   => $nombreProceso,
                'hora'          => $hora,
            ]);
            //END

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

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ PROCESO
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó configuración de proceso',
            'descripcion'   => $_POST['nombreProceso'],
            'hora'          => $hora,
        ]);
        //END

        if ($respuesta) {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/proceso')->with('mensaje', '5');
        }
    }

}

?>