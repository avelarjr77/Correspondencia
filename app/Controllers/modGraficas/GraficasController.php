<?php namespace App\Controllers\modGraficas;

use App\Controllers\BaseController;
use App\Models\modUsuario\UsuarioModel;
use App\Models\modGraficas\GraficasModel;

class GraficasController extends BaseController{


  public function index(){

    $grafica = new GraficasModel();

    $query =  $grafica->pastelG();
    $queryE =  $grafica->pastelE();
    $queryD =  $grafica->departamento(); 

    $data = [];

    foreach($query as $row) {
        $data['label'][] = $row->genero;
        $data['data'][] = (int) $row->total;
    }

    foreach($queryE as $row) {
      $data['label2'][] = $row->estado;
      $data['data2'][] = (int) $row->totalE;
    }

    foreach($queryD as $row) {
      $data['label3'][] = $row->departamento;
      $data['data3'][] = (int) $row->totalD;
    }
    
    $data['chart_data'] = json_encode($data);

    return view('modGraficas/graficas', $data);
  }

  public function proceso(){

    $grafica = new GraficasModel();
    $query =  $grafica->barraProcesoPersona(); 

    $session = session();

    $usuario = $session->usuario;

    $tact = new UsuarioModel();
    $personaId = $tact->asArray()->select('u.personaId, p.departamentoId')
        ->from('wk_usuario u')
        ->join('wk_persona p', 'u.personaId = p.personaId')
        ->where('u.usuario', $session->usuario)
        ->first();

    $pP = $grafica->progresoP($personaId['personaId']);
    $iP = $grafica->inactivoP($personaId['personaId']);
    $fP = $grafica->finalizadoP($personaId['personaId']);

    $data = [];

    foreach($query as $row) {
        $data['label'][] = $row->persona;
        $data['data'][] = (int) $row->total;
    }

    $data['chart_dataL'] = json_encode($data);

    $data['pP'] = $pP;
    $data['iP'] = $iP;
    $data['fP'] = $fP;

    return view('modGraficas/graficasProceso', $data);
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
    
    //$data['chart_data'] = json_encode($data); 

    echo json_encode($data);

    //return view('modGraficas/graficas', $data);
  }

  public function barraProm(){

    $grafica = new GraficasModel();
    
    $fecha = $this->request->getVar('fecha');

    $fechas = explode(" - ", $fecha);

    $fechaI = $fechas[0];
    $fechaF = $fechas[1];

    $query =  $grafica->barraProm($fechaI, $fechaF); 

    //$record = $query->result();
    $data = [];

    foreach($query as $row) {
        $data['label'][] = $row->persona;
        $data['data'][] = (int) $row->promedio;
    }

    echo json_encode($data);
  }

  public function barraP(){

    $grafica = new GraficasModel();
    
    $calendario = $this->request->getVar('calendario');

    $fechas = explode(" - ", $calendario);

    $fechaI = $fechas[0];
    $fechaF = $fechas[1];

    $query =  $grafica->barraP($fechaI, $fechaF); 

    $data = [];

    foreach($query as $row) {
        $data['label'][] = $row->proceso;
        $data['data'][] = (int) $row->tiempo;
    }

    echo json_encode($data);
  }

  public function line(){

    $grafica = new GraficasModel();

    $query =  $grafica->line(); 

    $session = session();

    $usuario = $session->usuario;

    $tact = new UsuarioModel();
    $personaId = $tact->asArray()->select('u.personaId, p.departamentoId')
        ->from('wk_usuario u')
        ->join('wk_persona p', 'u.personaId = p.personaId')
        ->where('u.usuario', $session->usuario)
        ->first();

    $p = $grafica->progreso($personaId['personaId']);
    $i = $grafica->inactivo($personaId['personaId']);
    $f = $grafica->finalizado($personaId['personaId']);
    
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

  public function departamento(){

    $grafica = new GraficasModel();
    
    $fecha = $this->request->getVar('fecha');

    $fechas = explode(" - ", $fecha);

    $fechaI = $fechas[0];
    $fechaF = $fechas[1];

    $query =  $grafica->departamento($fechaI, $fechaF); 

    //$record = $query->result();
    $data = [];

    foreach($query as $row) {
        $data['label'][] = $row->persona;
        $data['data'][] = (int) $row->promedio;
    }

    echo json_encode($data);
  }
}

?>