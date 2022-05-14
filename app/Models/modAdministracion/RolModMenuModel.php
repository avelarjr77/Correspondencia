<?php

namespace App\Models\modAdministracion;

use CodeIgniter\Model;

class RolModMenuModel extends Model
{
    protected $table = 'co_rol_modulo_menu';
    protected $primaryKey = 'rolModuloMenuId';
    protected $allowedFields = ['rolModuloMenuId', 'rolId', 'moduloMenuId'];

    public function getRolMM(){
        return $this->asObject()
        ->select("co_rol_modulo_menu.rolModuloMenuId as 'id', co_rol_modulo_menu.rolId, r.nombreRol as 'rol', mod.nombre as 'modulo', m.nombreMenu as 'menu', mm.moduloId, mm.menuId")
        ->join('wk_rol r','r.rolId = co_rol_modulo_menu.rolId')
        ->join('co_modulo_menu mm','mm.moduloMenuId = co_rol_modulo_menu.moduloMenuId')
        ->join('co_modulo mod','mod.moduloId = mm.moduloId')
        ->join('co_menu m','m.menuId = mm.menuId')
        ->orderBy('co_rol_modulo_menu.rolModuloMenuId')
        ->findAll();
    }

    /*public function getModMenu$moduloId)
    
        return $this->asObject()
        ->select("mm.moduloMenuId as 'idM', me.nombreMenu as 'nomMenu'")
        ->from("co_modulo_menu mm")
        ->join('co_modulo m','mm.moduloId = m.moduloId')
        ->join('co_menu me','mm.menuId = me.menuId')
        ->where('mm.moduloId', $moduloId)
        ->orderBy('mm.moduloMenuId')
        ->findAll();
    }*/

    public function getModMenu($moduloId)
    {
        $modulo = $this->db->query("SELECT mm.moduloMenuId as 'idM', me.nombreMenu as 'nomMenu', m.nombre as 'modulo', r.rolId as 'rolId'
                                    FROM co_rol_modulo_menu rmm
                                    INNER JOIN wk_rol r ON rmm.rolId = r.rolId
                                    INNER JOIN co_modulo_menu mm ON rmm.moduloMenuId = mm.moduloMenuId 
                                    INNER JOIN co_modulo m ON mm.moduloId = m.moduloId
                                    INNER JOIN co_menu me ON mm.menuId = me.menuId  
                                    WHERE mm.moduloId = '$moduloId'
                                    ORDER BY rmm.rolModuloMenuId");
        return $modulo->getResult();
    }

    public function getRolMenu($rolId){
        return $this->asObject()
        ->select("co_rol_modulo_menu.rolModuloMenuId as 'id', m.nombreMenu as 'menu'")
        ->join('wk_rol r','r.rolId = co_rol_modulo_menu.rolId')
        ->join('co_modulo_menu mm','mm.moduloMenuId = co_rol_modulo_menu.moduloMenuId')
        ->join('co_menu m','m.menuId = mm.menuId')
        ->where('r.rolId', $rolId)
        ->orderBy('co_rol_modulo_menu.rolModuloMenuId')
        ->findAll();
    }

    public function insertar($data){

        $nombre = $this->db->table('co_rol_modulo_menu');
        $nombre->insert($data);

        return $this->db->insertID();
    }

    public function eliminarR($id){
        $nombres = $this->db->table('co_rol_modulo_menu');
        $nombres->where($id);
        
        return $nombres->delete();
    }
}