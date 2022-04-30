<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class IconoModel extends Model
{
    protected $table      = 'wk_icono';
    protected $primaryKey = 'iconoId';
    protected $allowedFiels=['nombreIcono'];
}