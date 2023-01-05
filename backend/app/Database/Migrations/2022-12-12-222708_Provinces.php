<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Provinces extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'code' => [
				'type' => 'VARCHAR',
				'constraint' => 2
            ],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ]	
		]);
		$this->forge->addKey('code', TRUE);
		$this->forge->createTable('provinces');

		$seeder = \Config\Database::seeder();
		$seeder->call('ProvincesSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('provinces');
    }
}
