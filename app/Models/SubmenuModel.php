<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends SubmenuModel{
        protected $table = 'co_submenu';
        protected $primaryKey = 'subMenuId';
        protected $allowedFields = ['nombreSubMenu', 'menuId'];

}
