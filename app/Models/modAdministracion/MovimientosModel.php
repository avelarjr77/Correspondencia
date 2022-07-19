<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class MovimientosModel extends Model{

   protected $table = 'wk_bitacora';
   protected $primaryKey = 'bitacoraId';
   protected $allowedFields = ['bitacoraId','usuario','accion','descripcion','hora'];

   protected $useTimestamps = true;
   protected $createdField  = 'fecha';
   protected $updatedField  = '';
   protected $deletedField  = '';

   public function listarBitacora()
    {

        $persona = $this->db->query('SELECT*FROM  wk_bitacora');
        return $persona->getResult();
    }

}