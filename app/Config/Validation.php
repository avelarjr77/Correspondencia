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

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

}
