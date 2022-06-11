<?php 
namespace App\Models\modUsuario;

use CodeIgniter\Model;

class TipoEnvioModel extends Model{

   protected $table = 'wk_tipo_envio';
   protected $primaryKey = 'tipoEnvioId';
   protected $allowedFields = ['tipoEnvioId','tipoEnvio'];

   //Edita el registro en tipo envio
   public function actualizar($data, $tipoEnvioId){
      $tipoEnvio = $this->db->table('wk_tipo_envio');
      $tipoEnvio->set($data);
      $tipoEnvio->where('tipoEnvioId', $tipoEnvioId);
      return $tipoEnvio->update();
  }

}