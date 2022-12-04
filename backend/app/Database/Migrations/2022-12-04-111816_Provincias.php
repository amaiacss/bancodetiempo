<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Provincias extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'titulo_es'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'codigo' => [
				'type' => 'VARCHAR',
				'constraint' => 2
			]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('provincias');

		$seeder = \Config\Database::seeder();
		$seeder->call('ProvinciasSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('provincias');
    }
}
