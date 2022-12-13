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
            ],
            'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],	
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
