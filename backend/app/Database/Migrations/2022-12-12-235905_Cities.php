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
            ]	
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
