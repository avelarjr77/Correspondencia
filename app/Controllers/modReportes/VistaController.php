<?php

namespace App\Controllers\modReportes;

use App\Controllers\BaseController;
use App\Models\modReportes\PruebaModel;

use \Mpdf\Mpdf;
require_once 'vendors/mpdf/vendor/autoload.php';

class VistaController extends BaseController
{
    //LISTADO DE ROL MODULO MENU
    public function index()
    {
        //$prueba = new PruebaModel();

            
        //$mpdf = new \Mpdf\Mpdf();

        $mpdf = new Mpdf(['mode' => 'utf-8']);
        $mpdf->WriteHTML('Hello World');
        return redirect()->to($mpdf->Output('filename.pdf', 'I'));
        
        //$html = view('modReportes/vista',[]);

        //$mpdf->allow_charset_conversion=true;
    
        /* $mpdf->SetHeader('
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
    
        //$mpdf->charset_in='utf8';
    
        $mpdf->writeHTML('Hola');
    
        $file_ruta="../../../media/tmp/Prueba.pdf";

        $mpdf->Output($file_ruta,'I'); */

        //return view('modReportes/vista');

        //return redirect()->to($mpdf->Output($file_ruta,'I'));

    }
}
