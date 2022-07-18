<?php 
namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class MovimientosModel extends Model{

   protected $table = 'wk_bitacora';
   protected $primaryKey = 'bitacoraId';
   protected $allowedFields = ['bitacoraId','usuarioId','accion','descripcion','hora'];

   protected $useTimestamps = true;
   protected $createdField  = 'fecha';
   protected $updatedField  = '';
   protected $deletedField  = '';

   public function listarBitacora()
    {

        $persona = $this->db->query("SELECT b.bitacoraId as 'bitacoraId', u.usuario as 'usuario', b.accion as 'accion',
                                        b.descripcion as 'descripcion',b.fecha as 'fecha',b.hora as 'hora'
                                        FROM wk_bitacora b
                                        INNER JOIN wk_usuario u ON b.usuarioId = u.usuarioId
                                        ORDER BY b.bitacoraId");
        return $persona->getResult();
    }

}