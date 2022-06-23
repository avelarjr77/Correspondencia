<?php namespace App\Controllers\modGraficas;

use App\Controllers\BaseController;
use App\Models\modGraficas\GraficasModel;

class GraficasController extends BaseController{


    public function index(){

      $grafica = new GraficasModel();

      $query =  $grafica->bar(); 

      //$record = $query->result();
      $data = [];

      foreach($query as $row) {
          $data['label'][] = $row->persona;
          $data['data'][] = (int) $row->total;
      }
      
      $data['chart_data'] = json_encode($data);

      return view('modGraficas/graficas', $data);
    }

    public function barraF(){

      $grafica = new GraficasModel();
      
      $fecha = $this->request->getVar('fecha');

      $fechas = explode(" - ", $fecha);

      $fechaI = $fechas[0];
      $fechaF = $fechas[1];

      $query =  $grafica->barra($fechaI, $fechaF); 

      //$record = $query->result();
      $data = [];

      foreach($query as $row) {
          $data['label'][] = $row->persona;
          $data['data'][] = (int) $row->total;
      }
      
      $data['chart_data'] = json_encode($data); 

      //echo json_encode($data);

      //return view('modGraficas/graficas', $data);
    }

    public function line(){

      $grafica = new GraficasModel();

      $query =  $grafica->line(); 

      $p = $grafica->progreso();
      $i = $grafica->inactivo();
      $f = $grafica->finalizado();
      

      //$record = $query->result();
      $data = [];

      foreach($query as $row) {
          $data['label'][] = $row->mes;
          $data['data'][] = (int) $row->total;
      }
      
      $data['chart_dataL'] = json_encode($data);

      $data['p'] = $p;
      $data['i'] = $i;
      $data['f'] = $f;

      return view('modGraficas/graficaLineal', $data);
    }
}

?>