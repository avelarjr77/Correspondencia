<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class RolMMModel extends Model
{
    public function editar($data)
    {
        $idRolMM = $this->db->table('co_rol_modulo_menu');
        $idRolMM->where($data);
        return $RolMM->get()->getResultArray();
    }
}