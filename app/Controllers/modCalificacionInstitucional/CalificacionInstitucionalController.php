<?php namespace App\Controllers\modCalificacionInstitucional;
use App\Controllers\BaseController;

class CalificacionInstitucionalController extends BaseController{

    public function calificacionInstitucional(){
       return view('modCalificacionInstitucional/calificacionInstitucional');
    }
}