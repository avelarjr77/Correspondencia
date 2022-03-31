<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table = "co_submenu";

    protected $primaryKey = 'subMenuId';

    protected $useAutoIncrement = true;

    public function get($nombreSubMenu = null)
    {
        if ($nombreSubMenu === null) {
            return $this->findAll();
        }

        return $this->asArray()
        ->where(['nombreSubMenu' => $nombreSubMenu])
        ->first();
    }
}
