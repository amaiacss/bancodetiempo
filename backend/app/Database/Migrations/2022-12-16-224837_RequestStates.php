<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestStates extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'           => 'VARCHAR',
                'constraint'     => 1                
            ),
            'name_es' => array(
                'type'       => 'VARCHAR',    
                'constraint' => 20          
			), 
            'name_eu' => array(
                'type'       => 'VARCHAR',    
                'constraint' => 20          
			),     
			'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);        
        $this->forge->createTable('requeststates');

        $seeder = \Config\Database::seeder();
		$seeder->call('RequestStatesSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('requeststates');
    }
}
