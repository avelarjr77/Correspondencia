<?php namespace App\Controllers\modGraficas;

use App\Controllers\BaseController;
use App\Models\modGraficas\GraficasModel;

class GraficasController extends BaseController{

    //LISTAR ROLES

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
}

?>