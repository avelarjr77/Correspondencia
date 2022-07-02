<?php

namespace App\Models\modTransaccion;

use CodeIgniter\Model;

class TransaccionDocumentoModel extends Model
{
    protected $table = 'wk_documento';
    protected $primaryKey = 'documentoId';
    protected $allowedFields = ['documentoId', 'nombreDocumento', 'documento', 'tipoDocumentoId', 'transaccionActividadId'];

}