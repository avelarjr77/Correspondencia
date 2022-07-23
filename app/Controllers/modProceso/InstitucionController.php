<?php namespace App\Controllers\modProceso;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modProceso\InstitucionModel;
use App\Models\modAdministracion\MovimientosModel;

class InstitucionController extends BaseController{

    //LISTAR INSTITUCION

    public function institucion(){

        $nombreInstitucion = new InstitucionModel();
        $datos = $nombreInstitucion->listarInstitucion();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modProceso/institucion', $data);
    }

    //CREAR INSTITUCION
    public function crear(){

        $datos = [
            "nombreInstitucion" => $_POST['nombreInstitucion']
        ];

        //PARA REGISTRAR EN BITACORA QUIEN CREÓ INSTITUCIÓN
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Agregó institución',
            'descripcion'   => $_POST['nombreInstitucion'],
            'hora'          => $hora,
        ]);
        //END

        $nombreInstitucion  = new InstitucionModel();
        $respuesta          = $nombreInstitucion->insertar($datos);

        if ($respuesta > 0){
            return redirect()->to(base_url(). '/institucion')->with('mensaje','0');
        } else {
            return redirect()->to(base_url(). '/institucion')->with('mensaje','1');
        } 
    } 

    //ELIMINAR INSTITUCION
    public function eliminar(){

        $institucionId = $_POST['institucionId'];

        $Institucion = new InstitucionModel();
        $data = ["institucionId" => $institucionId];

        $nombreInstitucion = $Institucion->asArray()->select("nombreInstitucion")
        ->where("institucionId", $institucionId)->first();

        $respuesta = $Institucion->eliminar($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINÓ INSTITUCIÓN
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó institución',
                'descripcion'   => $nombreInstitucion,
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/institucion')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/institucion')->with('mensaje','3');
        }
    }

    //EDITAR INSTITUCION
    public function actualizar()
    {
        $datos = [
            "nombreInstitucion" => $_POST['nombreInstitucion']
        ];

        $institucionId = $_POST['institucionId'];

        $nombreInstitucion = new InstitucionModel();
        $respuesta = $nombreInstitucion->actualizar($datos, $institucionId);

        $datos = ["datos" => $respuesta];

        //PARA REGISTRAR EN BITACORA QUIEN EDITÓ INSTITUCIÓN
        $this->bitacora  = new MovimientosModel();
        $hora=new Time('now');
        $session = session('usuario');

        $this->bitacora->save([
            'bitacoraId'    => null,
            'usuario'       => $session,
            'accion'        => 'Editó institución',
            'descripcion'   => $_POST['nombreInstitucion'],
            'hora'          => $hora,
        ]);
        //END

        if ($respuesta) {
            return redirect()->to(base_url() . '/institucion')->with('mensaje', '4');
        } else {
            return redirect()->to(base_url() . '/institucion')->with('mensaje', '5');
        }
    }
    
}

?>