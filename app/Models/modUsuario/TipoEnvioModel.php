<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class TipoEnvioModel extends Model{

   protected $table = 'wk_tipo_envio';
   protected $primaryKey = 'tipoEnvioId';
   protected $allowedFields = ['tipoEnvioId','tipoEnvio'];

}