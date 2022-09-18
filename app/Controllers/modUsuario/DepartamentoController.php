<?php namespace App\Controllers\modUsuario;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modUsuario\DepartamentoModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modUsuario\PersonaModel;

class DepartamentoController extends BaseController{

    //LISTAR ROLES

    public function departamento(){

        $nombreDepartamento = new DepartamentoModel();
        $datos = $nombreDepartamento->listarDepartamento();

        $mensaje = session('mensaje');

        $data = [
            "datos"     => $datos,
            "mensaje"   => $mensaje
        ];

        return view('modUsuario/departamento', $data);
        }

    //CREAR ROLES
    public function crear(){

        $departamento = new DepartamentoModel();

        if($this->validate('validarDepart')){
            $departamento->insertar(
                [
                    "departamento"  => $_POST['departamento']
                ]
            );

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ EL DEPARTAMENTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó departamento',
                'descripcion'   => $_POST['departamento'],
                'hora'          => $hora,
            ]);

            return redirect()->to(base_url(). '/departamento')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/departamento')->with('mensaje','1');
    } 

    //ELIMINAR ROLES
    public function eliminar(){

        $departamentoId = $_POST['departamentoId'];

        $departamento   = new DepartamentoModel();
        $persona        = new PersonaModel();
        $data           = ["departamentoId" => $departamentoId];

        $nombreDepartamento = $departamento->asArray()->select("departamento")
        ->where("departamentoId", $departamentoId)->first();

        //Para buscar si el Departamento está relacionado con una Persona
        $buscarRelacion = $persona->select('departamentoId')->where('departamentoId', $departamentoId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/departamento')->with('mensaje', '6');
        }

        $respuesta = $departamento->eliminar($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO EL DEPARTAMENTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó departamento',
                'descripcion'   => $nombreDepartamento,
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/departamento')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/departamento')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $departamento = new DepartamentoModel();
        if ($this->validate([
            'departamento'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_departamento.departamento]'
            ])) {
                $datos = [
                    "departamento"        => $_POST['departamento']
                ];

            $departamentoId = $_POST['departamentoId'];
            $respuesta = $departamento->actualizar($datos, $departamentoId);

            $datos = ["datos" => $respuesta];

            //PARA REGISTRAR EN BITACORA QUIEN EDITO EL DEPARTAMENTO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Editó departamento',
                'descripcion'   => $_POST['departamento'],
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url() . '/departamento')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/departamento')->with('mensaje', '5');
        }         
    }
    
}

?>