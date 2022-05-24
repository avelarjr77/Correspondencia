<?php 
namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model{

    //LISTADO DE ROL
    public function obtenerRol()
    {
        $rol =  $this->db->query('SELECT * FROM wk_rol');
        return $rol->getResult();
    }

}