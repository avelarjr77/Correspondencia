<?php

namespace App\Controllers\modReportes;

use App\Controllers\BaseController;
use App\Models\modReportes\PruebaModel;

use \Mpdf\Mpdf;
require_once 'vendors/mpdf/vendor/autoload.php';
require_once '../sql/conexion.php';

class ProcesoDetalleController extends BaseController
{
    public function index()
    {
        $prueba = new PruebaModel();

        $datos =  $prueba->reporte3();

        $contexto="";
        $correlativo=1;
        $data = [];

        if ($datos>0) {
            foreach($datos as $row) {
                $contexto = $contexto . '
                <tr class="estilo" style="font-size:12;">
                    <td style="text-align:center;">'.$correlativo.'</td>
                    <td style="text-align:center;">'.$row->proceso.'</td>
                    <td style="text-align:center;">'.$row->etapa.'</td>
                    <td style="text-align:center;">'.$row->actividad.'</td>
                    <td style="text-align:center;">'.$row->estado.'</td>
                </tr><br>
                ';
                $correlativo++;
            
        
                $tabla_a_imprimir='
                <style>
                    .estilo{
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                </style>
                <p style="text-align:center; font-size:16;"><b>Flujo de Procesos del mes de '.$row->mes.'</b></p><br>
                <table class="estilo" style="width:100%;">
                    <thead>
                        <tr class="estilo">
                            <th style="width:5%;">#</th>
                            <th style="width:30%;">Proceso</th>
                            <th style="width:30%;">Etapa</th>
                            <th style="width:25%;">Actividad</th>
                            <th style="width:15%;">Estado</th>
                        </tr>
                    </thead><br>
                    <tbody>'.$contexto.'</tbody>
                </table>';

            }
            
            $mpdf = new \Mpdf\Mpdf(['mode'=>'utf8', 'format'=>'Letter-P', 'setAutoTopMargin'=>'stretch']);
        
            $mpdf->allow_charset_conversion=true;

            $mpdf->defaultheaderline = 0;
            $mpdf->defaultfooterline = 0;
        
            $mpdf->SetHeader('
            <table style="width=100%;">
                <tr>
                    <td><img src="images/membrete.jpg"></td>
                </tr>
            </table>
            ');
        
            $mpdf->setHTMLFooter(
                '
                <img src="images/Sin-título-1.jpg">
                <table style="width=100%;">
                    <tr>
                        <td style="float:left;width:68%;">Página {PAGENO} de {nb}</td>
                        <td style="float:right;width:32%;">Fecha de Impresión: '.date('d/m/Y H:i:s').'</td>
                    </tr>
                </table>
                '
            );
        
            $mpdf->charset_in='utf8';
        
            $mpdf->writeHTML($tabla_a_imprimir);
        
            $file="FlujoDeProcesos.pdf";

            $mpdf->Output($file,'I');
            $this->response->setHeader('Content-Type', 'application/pdf');
        
        }else{
            echo json_encode($datos);
        }
    }
}
