<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */

    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public $menuValidation = [
        'nombreMenu'   => 'required|is_unique[co_menu.nombreMenu]',
        'identificador' => 'required|min_length[2]',
    ];

    public $validation = [
        'nombre'        => 'min_length[3]|max_length[45]|alpha|is_unique[co_modulo.nombre]',
        'descripcion'        => 'min_length[3]|max_length[45]|alpha_space',
        'archivo'        => 'min_length[3]|max_length[45]'
    ];

    public $validarRol = [
        'nombreRol'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_rol.nombreRol]'
    ];

    public $validarPersona = [
        'nombres'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_persona.nombres]',
        'primerApellido'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_persona.primerApellido]',
        'segundApellido'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_persona.segundoApellido]'
    ];

    public $validarCargo = [
        'cargo'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_cargo.cargo]'
    ];

    public $validarDepart = [
        'departamento'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_departamento.departamento]'
    ];

    public $validarContacto = [
        'tipoContacto'        => 'min_length[3]|max_length[20]|is_unique[wk_tipo_contacto.tipoContacto]|alpha_space'
    ];

    public $datosvacios = [
        'estado'        => 'required'
    ];

    public $validarDocumento = [
        'nombreDocumento'        => 'min_length[3]|max_length[75]|is_unique[wk_documento.nombreDocumento]|alpha_space',
        'documento'        => 'min_length[3]|max_length[45]|is_unique[wk_documento.documento]|alpha_space',
        'tipoDocumentoId'        => 'required',
        'tipoEnvioId'        => 'required',
        'transaccionActividadId'        => 'required'
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

}
