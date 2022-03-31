<?php namespace App\Models;

    use CodeIgniter\Model;

    class MenuSubmenuModel extends Model{
        public function listarMenu(){
            $co_menu = $this->db->query('SELECT*FROM co_menu');
            return $co_menu->getResult();
        }

        public function insertar($datos){
            $nombreMenu = $this->db->table('co_menu');
            $nombreMenu->insert($datos);

            return $this->db->insertID();
        }
    }