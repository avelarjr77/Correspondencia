<?php namespace App\Controllers\modAdministracion;
use App\Controllers\BaseController;

class AdministracionController extends BaseController{

    public function administracion(){
       return view('modAdministracion/administracion');
    }
}