<?php namespace App\Controllers\modProceso;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modProceso\TipoProcesoModel;
use App\Models\modAdministracion\MovimientosModel;

class TipoProcesoController extends BaseController{

    //LISTAR TIPO PROCESO

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

    //CREAR TIPO PROCESO
    public function crear(){

        $datos = [
            "tipoProceso" => $_POST['tipoProceso']
        ];

        //PARA REGISTRAR EN BITACORA QUIEN CREÓ TIPO DE PORCESO
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó tipo de proceso',
            'descripcion'   => $_POST['tipoProceso'],
            'hora'          => $hora,
        ]);

        $tipoProceso = new TipoProcesoModel();
        $respuesta = $tipoProceso->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','1');
        }
    }

    //ELIMINAR TIPO PROCESO
    public function eliminar(){

        $tipoProcesoId = $_POST['tipoProcesoId'];

        $tipoProceso = new TipoProcesoModel();
        $data = ["tipoProcesoId" => $tipoProcesoId];

        $nombreTipoProceso = $tipoProceso->asArray()->select("tipoProceso")
        ->where("tipoProcesoId", $tipoProcesoId)->first();

        $respuesta = $tipoProceso->eliminar($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINÓ TIPO PROCESO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó tipo de proceso',
                'descripcion'   => $nombreTipoProceso,
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/tipoProceso')->with('mensaje','3');
        }
    }

    //EDITAR TIPO PROCESO
    public function actualizar()
    {
        $datos = [
            "tipoProceso" => $_POST['tipoProceso']
        ];

        $tipoProcesoId = $_POST['tipoProcesoId'];

        $tipoProceso = new TipoProcesoModel();
        $respuesta = $tipoProceso->actualizar($datos, $tipoProcesoId);

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ TIPO DE PORCESO
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó tipo de proceso',
            'descripcion'   => $_POST['tipoProceso'],
            'hora'          => $hora,
        ]);

        if ($respuesta) {
            return redirect()->to(base_url() . '/tipoProceso')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/tipoProceso')->with('mensaje', '5');
        }
    }
}

?>