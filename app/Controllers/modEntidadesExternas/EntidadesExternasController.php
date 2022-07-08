<?php namespace App\Controllers\modEntidadesExternas;
use App\Controllers\BaseController;

class EntidadesExternasController extends BaseController{

    public function entidadesExternas(){
       return view('modEntidadesExternas/entidadesExternas');
    }
}