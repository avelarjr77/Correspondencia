<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\IconoModel;
use App\Models\modAdministracion\ModuloModel;

class ModuloController extends BaseController{

    
    //LISTAR MODULOS
    public function adminModulo(){

        $Modulo = new ModuloModel();
        $icono = new IconoModel();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $Modulo->asObject()->join('wk_icono','wk_icono.iconoId = co_modulo.iconoId')->findAll(),
            "icono" => $icono->asObject()->findAll(),
            "mensaje"   => $mensaje
        ];

        return view('modAdministracion/adminModulo', $data);
        }
    //CREAR MODULOS
    public function crearModulo(){

        $Modulo = new ModuloModel();

        if($this->validate('validation')){
            $Modulo->insertar(
                [
                    "nombre"        => $_POST['nombre'],
                    "iconoId"       => $_POST['iconoId'],
                    "descripcion"   => $_POST['descripcion'],
                    "archivo"       => $_POST['archivo']
                ]
            );

            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','1');

    } 

    //ELIMINAR MODULOS
    public function eliminar(){

        $moduloId = $_POST['moduloId'];

        $Modulo = new ModuloModel();
        $data = ["moduloId" => $moduloId];

        $respuesta = $Modulo->eliminar($data);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/adminModulo')->with('mensaje','3');
        }
    }

    
    //Funcion para EDITAR
    /*public function obtenerModulo($nombres)
    {
        $data = [ "moduloId" => $nombres];
        $nombreModulo = new ModuloModel();
        $respuesta = $nombreModulo->obtenerModulo($data);
        $datos = ["datos" => $respuesta];
        return view('modAdministracion/actualizarModulo', $datos);
    }*/

    public function actualizarModulo()
    {
      $nombreModulo = new ModuloModel();
      if ($this->validate([
            'nombre'        => 'min_length[3]|max_length[45]|alpha|is_unique[co_modulo.nombre]',
            'descripcion'        => 'min_length[3]|max_length[45]',
            'archivo'        => 'min_length[3]|max_length[45]'
        ])) {
            $datos = [
                "nombre"        => $_POST['nombre'],
                "iconoId"       => $_POST['iconoId'],
                "descripcion"   => $_POST['descripcion'],
                "archivo"       => $_POST['archivo']
            ];

        $moduloId = $_POST['moduloId'];

        
        $respuesta = $nombreModulo->actualizarModulo($datos, $moduloId);

        $datos = ["datos" => $respuesta];
        
        return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '4');

        } else {
            return redirect()->to(base_url() . '/adminModulo')->with('mensaje', '5');
        } 

        
    }    

    
}

?>