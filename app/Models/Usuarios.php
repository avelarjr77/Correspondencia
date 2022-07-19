<?php namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model {

    protected $table   = 'wk_usuario';

    public function obtenerUsuario(string $column, $value){

        return $this->where($column, $value)->first();
    }

    public function obtenerId(string $column, $value){

        return $this->where($column, $value)->first();
    }
}


?>