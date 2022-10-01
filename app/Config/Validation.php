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
        'nombreMenu' => 'required|is_unique[co_menu.nombreMenu]|alpha_space',
        'iconoId' => 'required',
    ];

    public $validarsubmenu = [
        'nombreSubMenu' => 'min_length[3]|max_length[45]|required|is_unique[co_submenu.nombreSubMenu]|alpha_space',
        'menuId' => 'required',
        'nombreArchivo' => 'min_length[3]|max_length[100]|required'
    ];

    public $validarModulo = [
        'nombre'        => 'is_unique[co_modulo.nombre]'
    ];

    public $validarModuloNumeros = [
        'nombre'        => 'alpha_space'
    ];


    public $validarModuloMenu = [
        'moduloId'        => 'is_unique[co_modulo_menu.moduloId]',
        'menuId'        => 'is_unique[co_modulo_menu.menuId]'
    ];

    public $validarRol = [
        'nombreRol'        => 'min_length[3]|max_length[45]|alpha|is_unique[wk_rol.nombreRol]'
    ];

    public $validarCargo = [
        'cargo'        => 'min_length[3]|max_length[45]|is_unique[wk_cargo.cargo]'
    ];

    public $validarCargoNumeros = [
        'cargo'        => 'min_length[3]|max_length[45]|alpha_space'
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
        'nombreDocumento'        => 'is_unique[wk_documento.nombreDocumento]'
    ];
    
    public $validarDoc = [
        'nombreDocumento'        => 'is_unique[wk_documento.nombreDocumento]'
    ];

    public $validarPersona = [
        'nombres'        => 'alpha_space',
        'primerApellido'        => 'alpha',
        'segundoApellido'        => 'alpha'
    ];

    public $validarTipoEnvio = [
        'tipoEnvio'        => 'is_unique[wk_tipo_envio.tipoEnvio]|alpha_space'
    ];

    public $validarUsuario = [
        'usuario'        => 'is_unique[wk_usuario.usuario]|alpha_numeric'
    ];

    public $validarProceso = [
        'nombreProceso' => 'is_unique[wk_proceso.nombreProceso]|alpha_numeric_space'
    ];

    public $validarDUI = [
        'dui' => 'is_unique[wk_persona.dui]'
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

}


