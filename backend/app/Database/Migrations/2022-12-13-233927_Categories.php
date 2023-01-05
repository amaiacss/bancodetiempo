<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
				'type'           => 'INT',
                'constraint'     => 2,
                'auto_increment' => TRUE
            ],
			'name_es'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ],
            'name_eu'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ],
            'picture'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ]	
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('categories');
        
        $seeder = \Config\Database::seeder();
		$seeder->call('CategoriesSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
