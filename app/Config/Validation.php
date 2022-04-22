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


<<<<<<< HEAD
=======
    public $users =[
		'usuario' => 'required|min_length[3]|max_length[20]|is_unique[wk_usuario.usuario]',
		'password' => 'required|min_length[5]|max_length[15]|is_unique[wk_usuario.usuario]'
	];

<<<<<<< HEAD

=======
>>>>>>> 97ba436138d5da4a82fdb216c1e10e8101148994
>>>>>>> 5c73d8fb27a8113dd4037d3e9a07dc32717dd3de
    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

}
