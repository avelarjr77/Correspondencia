<?php

namespace App\Controllers\modReportes;

use App\Controllers\BaseController;
use App\Models\modReportes\PruebaModel;

use \Mpdf\Mpdf;
require_once 'vendors/mpdf/vendor/autoload.php';
require_once '../sql/conexion.php';

class PruebaController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        $prueba = new PruebaModel();

        $datos =  $prueba->reporte();

        //$resultado=mysqli_query($conn, $datos);

        $contexto="";
        $correlativo=1;
        $data = [];

        if ($datos>0) {
            foreach($datos as $row) {
                $contexto = $contexto . '
                <tr>
                    <td style="text-align:center;">'.$correlativo.'</td>
                    <td>'.$row->proceso.'</td>
                    <td style="text-align:center;">'.$row->persona.'</td>
                    <td style="text-align:center;">'.$row->institucion.'</td>
                    <td style="text-align:center;">'.$row->estado.'</td>
                </tr><br>
                ';
                $correlativo++;
            }
        
            $tabla_a_imprimir='
            <h3 style="text-align:center;"><b>Listado de Procesos del presente mes</b></h3><br>
            <table border="0" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proceso</th>
                        <th>Encargado</th>
                        <th>Institución</th>
                        <th>Estado</th>
                    </tr>
                </thead><br>
                <tbody>'.$contexto.'</tbody>
            </table>';
            
            $mpdf = new \Mpdf\Mpdf(['mode'=>'utf8', 'format'=>'Letter-P', 'setAutoTopMargin'=>'stretch']);
            //$mpdf=new Mpdf(['mode'=>'utf8', 'format'=>'Letter-P', 'setAutoTopMargin'=>'stretch']);
        
            $mpdf->allow_charset_conversion=true;
        
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
                        <td style="float:left;width:55%;">Página {PAGENO} de {nb}</td>
                        <td style="float:right;width:45%;">Fecha de Impresión: '.date('d/m/Y H:i:s').'</td>
                    </tr>
                </table>
                '
            );
        
            $mpdf->charset_in='utf8';
        
            $mpdf->writeHTML($tabla_a_imprimir);
        
            //$file="../../../media/tmp/documento_imprimible.pdf";
            $file="../../../media/tmp/documento_imprimible.pdf";

            /* if (file_exists($file)) {
                mysqli_close($conn);
                unset($correlativo, $contexto,);
        
                $response=array('success'=>true, 'url'=>'media/tmp/documento_imprimible.pdf', 'resultado'=>$resultado);
            }else{
                $response=array('success'=>false, 'error'=>'No fue posible crear el archivo pdf');
            } */
        
            //$mpdf->Output($file, 'I');
            return redirect()->to($mpdf->Output($file,'I'));
        
        }else{
            echo json_encode($datos);
        }

        
    }

}
