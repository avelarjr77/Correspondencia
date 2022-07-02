<?php namespace App\Controllers\modPlanEstudio;
use App\Controllers\BaseController;

class PlanEstudioController extends BaseController{

    public function planEstudio(){
       return view('modPlanEstudio/planEstudio');
    }
}