<?php
namespace App\Controllers\modReportes;

use App\Controllers\BaseController;
use App\Models\modReportes\PruebaModel;

//require_once APPPATH.'third_party/fpdf/fpdf.php';

use \Mpdf\Mpdf;
//use Fpdf;
//require_once 'vendors/fpdf/fpdf.php';
require_once 'vendors/mpdf/vendor/autoload.php';
require_once '../sql/conexion.php';

class ProcesoUnicoController extends BaseController
{
    public function index($procesoId)
    {   
        $prueba = new PruebaModel();

        //$procesoId = $_POST['procesoId'];

        $datos =  $prueba->reporteProceso($procesoId);

        $contexto="";
        $correlativo=1;

        if ($datos>0) {
            foreach($datos as $row) {
                $contexto = $contexto . '
                <tr style="font-size:12;">
                    <td style="text-align:center;">'.$correlativo.'</td>
                    <td style="text-align:center;">'.$row->proceso.'</td>
                    <td style="text-align:center;">'.$row->etapa.'</td>
                    <td style="text-align:center;">'.$row->actividad.'</td>
                    <td style="text-align:center;">'.$row->estado.'</td>
                    <td style="text-align:center;">'.$row->fechaInicio.'</td>
                    <td style="text-align:center;">'.$row->horaInicio.'</td>
                    <td style="text-align:center;">'.$row->fechaFin.'</td>
                    <td style="text-align:center;">'.$row->horaFin.'</td>
                </tr><br>
                ';
                $correlativo++;
            
        
                $tabla_a_imprimir='
                <style>
                    table, th, td{
                        border: 1px solid black;
                        border-collapse: collapse;
                    },
                    .estilo{
                        border: 0px;
                    }
                </style>
                <p style="text-align:center; font-size:16;"><b>Detalle del Proceso '.$row->proceso.'</b></p><br>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width:3%;">#</th>
                            <th style="width:25%;">Proceso</th>
                            <th style="width:25%;">Etapa</th>
                            <th style="width:22%;">Actividad</th>
                            <th style="width:12%;">Estado</th>
                            <th style="width:10%;">Fecha de Inicio</th>
                            <th style="width:9%;">Hora de Inicio</th>
                            <th style="width:10%;">Fecha de Fin</th>
                            <th style="width:9%;">Hora de Fin</th>
                        </tr>
                    </thead><br>
                    <tbody>'.$contexto.'</tbody>
                </table>';

            }
            
            $mpdf = new \Mpdf\Mpdf(['mode'=>'utf8', 'format'=>'Letter-L', 'setAutoTopMargin'=>'stretch']);
        
            $mpdf->allow_charset_conversion=true;

            $mpdf->defaultheaderline = 0;
            $mpdf->defaultfooterline = 0;
        
            $mpdf->SetHeader('
            <table class="estilo" style="width=100%;">
                <tr class="estilo">
                    <td class="estilo"><img src="images/membrete.jpg"></td>
                </tr>
            </table>
            ');
        
            $mpdf->setHTMLFooter(
                '
                <img src="images/Sin-título-1.jpg">
                <table class="estilo" style="width=100%;">
                    <tr class="estilo">
                        <td class="estilo" style="float:left;width:63%;">Página {PAGENO} de {nb}</td>
                        <td class="estilo" style="float:right;width:27%;">Fecha de Impresión: '.date('d/m/Y H:i:s').'</td>
                    </tr>
                </table>
                '
            );
        
            $mpdf->charset_in='utf8';
        
            $mpdf->writeHTML($tabla_a_imprimir);
        
            $file="ProcesoUnico.pdf";

            $mpdf->Output($file,'I');
            $this->response->setHeader('Content-Type', 'application/pdf');
        
        }else{
            echo json_encode($datos);
        }
    }
}