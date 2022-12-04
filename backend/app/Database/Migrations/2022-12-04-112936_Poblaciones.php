<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Poblaciones extends Migration
{
    public function up()
    {
        $this->forge->addField([

			'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'codigo' => array(
                'type' => 'VARCHAR',
                'constraint' => 4
            ),
            'codigo_provincia' => array(
                'type' => 'VARCHAR',
                'constraint' => 2
            ),
            'codigo_full' => array(
                'type' => 'VARCHAR',
                'constraint' => 5,
                'unique' => TRUE
            ),
            'titulo' => array(
                'type' => 'VARCHAR',
                'constraint' => 250
            )
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('codigo_provincia');
        $this->forge->createTable('poblaciones');
                
         $seeder = \Config\Database::seeder();
		 $seeder->call('PoblacionesSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('poblaciones');
    }
}
