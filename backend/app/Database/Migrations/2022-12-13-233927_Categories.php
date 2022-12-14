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
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ],
            'picture'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
            ],
            'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],	
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('categories');		
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
