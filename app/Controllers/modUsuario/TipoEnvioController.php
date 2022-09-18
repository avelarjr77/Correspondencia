<?php namespace App\Controllers\modUsuario;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\modUsuario\TipoEnvioModel;
use App\Models\modAdministracion\MovimientosModel;
use App\Models\modUsuario\DocumentoModel;

class TipoEnvioController extends BaseController{

    //LISTAR TIPO ENVIO

    public function tipoEnvio(){

        $tipoEnvio  = new TipoEnvioModel();

        $mensaje    = session('mensaje');

        $data = [
            'datos'     =>$tipoEnvio->select("tipoEnvioId,tipoEnvio")->asObject()->findAll(),
            'mensaje'   => $mensaje
        ];

        return view('modUsuario/tipoEnvio',$data);
        }

    //CREAR TIPO ENVIO
    public function crear(){

        $tipoEnvio = new TipoEnvioModel();

        if($this->validate('validarTipoEnvio')){
            $tipoEnvio->insert(
                [
                    "tipoEnvio" => $_POST['tipoEnvio']
                ]
            );

            //PARA REGISTRAR EN BITACORA QUIEN CREÓ LA TIPO ENVIO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Agregó Tipo de envio',
                'descripcion'   => $_POST['tipoEnvio'],
                'hora'          => $hora,
            ]);
        //END

            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','0');
        }
        
            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','1');
    } 

    //ELIMINAR TIPO DE ENVIO
    public function eliminar(){

        $tipoEnvioId    = $_POST['tipoEnvioId'];
        $tipoEnvio      = new TipoEnvioModel();
        $documento      = new DocumentoModel();
        $data = [
            "tipoEnvioId" => $tipoEnvioId
        ];

        $nombreEnvio = $tipoEnvio->asArray()->select("tipoEnvio")
        ->where("tipoEnvioId", $tipoEnvioId)->first();

        //Para buscar si el Departamento está relacionado con una Persona
        $buscarRelacion = $documento->select('tipoEnvioId')->where('tipoEnvioId', $tipoEnvioId)->first();
        if ($buscarRelacion) {
            return redirect()->to(base_url() . '/tipoEnvio')->with('mensaje', '6');
        }

        $respuesta = $tipoEnvio->delete($data);

        if ($respuesta > 0){

            //PARA REGISTRAR EN BITACORA QUIEN ELIMINO TIPO DE ENVIO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Eliminó Tipo de envio',
                'descripcion'   => $nombreEnvio,
                'hora'          => $hora,
            ]);
            //END

            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','2');
        } else {
            return redirect()->to(base_url(). '/tipoEnvio')->with('mensaje','3');
        }
    }

    public function actualizar()
    {
        $tipoEnvio = new TipoEnvioModel();
        if ($this->validate([
            'tipoEnvio'        => 'is_unique[wk_tipo_envio.tipoEnvio]|alpha_space'
            ])) {
                $datos = [
                    "tipoEnvio" => $_POST['tipoEnvio']
                    
                ];

            $tipoEnvioId = $_POST['tipoEnvioId'];

            $respuesta = $tipoEnvio->actualizar($datos, $tipoEnvioId);

            $datos = ["datos" => $respuesta];

            //PARA REGISTRAR EN BITACORA QUIEN EDITÓ LA TIPO ENVIO
            $this->bitacora  = new MovimientosModel();
            $hora=new Time('now');
            $session = session('usuario');

            $this->bitacora->save([
                'bitacoraId'    => null,
                'usuario'       => $session,
                'accion'        => 'Editó Tipo de envio',
                'descripcion'   => $_POST['tipoEnvio'],
                'hora'          => $hora,
            ]);
        //END
            
            return redirect()->to(base_url() . '/tipoEnvio')->with('mensaje', '4');

            } else {
                return redirect()->to(base_url() . '/tipoEnvio')->with('mensaje', '5');
        }
    }
    
}

?>