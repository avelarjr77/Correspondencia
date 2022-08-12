<?php

namespace App\Controllers\modReportes;

use App\Controllers\BaseController;
use App\Models\modReportes\PruebaModel;

//use \Mpdf\Mpdf;
use Fpdf;
require_once 'vendors/fpdf/fpdf.php';
//require_once 'vendors/mpdf/vendor/autoload.php';
require_once '../sql/conexion.php';

class PDF extends FPDF{
    function Header(){
        $this->SetFont('Arial', 'B', '12');
        $this->Ln(5);
        $this->Cell(0, 0, utf8_decode('Reporte de Abogados'), 0, 2, 'C');
        $this->Cell(0, 9, utf8_decode('Filtro por rango de fechas'), 0, 2, 'C');
        $this->Image('images/membrete.jpg',0,0,260);
    }
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', '8');
        $this->Cell(100, 10, 'Página'.$this->PageNo().'/{nb}', 0, 0, 'L');
        $this->Cell(100, 10, 'Fecha de Impresión: '.date('d/m/Y H:i:s'), 0, 0, 'R');
    }
}
