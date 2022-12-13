<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cities extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'code' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'codeProvince' => [
				'type' => 'VARCHAR',
				'constraint' => 2
            ],
            'codeCity' => [
				'type' => 'VARCHAR',
				'constraint' => 4
            ],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ],
            'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],	
		]);
		$this->forge->addPrimaryKey('code');           
        $this->forge->addForeignKey('codeProvince','provinces','code');
		$this->forge->createTable('cities');

		$seeder = \Config\Database::seeder();
		$seeder->call('CitiesSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('cities');
    }
}
