<?php

namespace App\Controllers\modReportes;

use App\Controllers\BaseController;
use App\Models\modReportes\ReportesModel;

class ReportesController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $prueba = new ReportesModel();

        $datos =  $prueba->procesos();
        $persona =  $prueba->persona();

        $mes = date("n");

        switch ($mes) {
            case '1':
                $mess = 'Enero';
                break;
            case '2':
                $mess = 'Febrero';
                break;
            case '3':
                $mess = 'Marzo';
                break;
            case '4':
                $mess = 'Abril';
                break;
            case '5':
                $mess = 'Mayo';
                break;
            case '6':
                $mess = 'Junio';
                break;
            case '7':
                $mess = 'Julio';
                break;
            case '8':
                $mess = 'Agosto';
                break;
            case '9':
                $mess = 'Septiembre';
                break;
            case '10':
                $mess = 'Octubre';
                break;
            case '11':
                $mess = 'Noviembre';
                break;
            case '12':
                $mess = 'Diciembre';
                break;
        
            default:
                $mess = 'Enero';
                break;
        }

        $mensaje = session('mensaje');

        $dato = [
            "mensaje"   => $mensaje,
            "mes"   => $mess,
            "datos"   => $datos,
            "persona"   => $persona
        ];

        return view('modReportes/reportes', $dato);
    }

}
