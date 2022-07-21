<?php namespace App\Controllers\modAdministracion;

use App\Controllers\BaseController;
use App\Models\modAdministracion\RolModel;
use App\Models\modAdministracion\MovimientosModel;
use CodeIgniter\I18n\Time;

class RolController extends BaseController{

    //LISTAR ROLES
    public function adminRol(){

        $nombreRol = new RolModel();
        $datos = $nombreRol->listarRol();

        $mensaje = session('mensaje');

        $data = [
            "datos" => $datos,
            "mensaje" => $mensaje
        ];

        return view('modAdministracion/adminRol', $data);
        }

    //CREAR ROLES
    public function crear(){ 

        $nombreRol = new RolModel();

        if($this->validate('validarRol')){
            $nombreRol->insertar(
                [
                    "nombreRol"        => $_POST['nombreRol']
                ]
            );

            //PARA REGISTRAR EN BITACORA QUIEN CREO ROL
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $session,
                'accion' => 'Inserto un registro de la tabla rol',
                'descripcion' => $_POST['nombreRol'],
                'hora' => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/adminRol')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/adminRol')->with('mensaje','1');
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $rolId = $_POST['rolId'];

        $nombreRol = new RolModel();
        $data = ["rolId" => $rolId];

        $respuesta = $nombreRol->eliminar($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO ROL
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $session,
                'accion' => 'Elimino un registro de la tabla rol: ',
                'descripcion' => $data,
                'hora' => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/adminRol')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/adminRol')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $nombreRol = new RolModel();
        if ($this->validate([
                'nombreRol'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_rol.nombreRol]|alpha_space'
            ])) {
                $datos = [
                    "nombreRol"        => $_POST['nombreRol']
                ];

            $rolId = $_POST['rolId'];
            $respuesta = $nombreRol->actualizar($datos, $rolId);

            $datos = ["datos" => $respuesta];

            //PARA REGISTRAR EN BITACORA QUIEN EDITO ROL
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId' => null,
                'usuario' => $session,
                'accion' => 'Edito un registro de la tabla rol',
                'descripcion' => $_POST['nombreRol'],
                'hora' => $hora,
            ]);
            //END
            
            return redirect()->to(base_url() . '/adminRol')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/adminRol')->with('mensaje', '5');
            } 
    }
    
}

?>