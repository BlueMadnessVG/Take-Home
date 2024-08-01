<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/* HERO TABLE */
class Hero extends Migration
{
    public function up()
    {
        // table rows information
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'thumbnail_path' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('hero');
    }

    public function down()
    {
        //when refresh or update
        $this->forge->dropTable('hero');
    }
}
