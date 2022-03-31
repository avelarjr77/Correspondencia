<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoMenu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menuId'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombreMenu'       => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
            ],
        ]);
        $this->forge->addKey('menuId', true);
        $this->forge->createTable('co_menu');
    }

    public function down()
    {
        $this->forge->dropTable('co_menu');
    }
}
