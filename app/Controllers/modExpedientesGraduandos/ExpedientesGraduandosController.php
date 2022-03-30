<?php namespace App\Controllers\modExpedientesGraduandos;
use App\Controllers\BaseController;

class ExpedientesGraduandosController extends BaseController{

    public function expedientesGraduandos(){
       return view('modExpedientesGraduandos/expedientesGraduandos');
    }
}