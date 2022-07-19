<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\MovimientosModel;

class BitacoraController extends BaseController
{

    public function bitacora(){

        $bitacora = new MovimientosModel();
        $datos = $bitacora->listarBitacora();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modAdministracion/bitacora', $data);
        }

}
