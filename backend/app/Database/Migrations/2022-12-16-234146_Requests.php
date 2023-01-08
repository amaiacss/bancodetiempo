<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Requests extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ),
            'hours' => array(
                'type'       => 'INT',
                'constraint' => 2,
                'default' => 0              
			),
            'idState' => array(
                'type'       => 'VARCHAR',
                'constraint' => 1
			),           
            'idActivity' => array(
                'type'           => 'INT',
                'constraint'     => 11            
			),
            'idUser' => [
				'type'           => 'INT',
                'constraint'     => 11                
            ],
                      
			'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idActivity', 'activities', 'id');
        $this->forge->addForeignKey('idUser', 'users', 'id');
        $this->forge->addForeignKey('idState', 'requeststates', 'id');
        $this->forge->createTable('requests');

        $this->db->query('CREATE TRIGGER after_requests_update AFTER UPDATE ON requests '.
        'FOR EACH ROW '.
        'BEGIN '.
        'IF new.idState = \'F\' THEN '.
		'UPDATE profiles SET credit = credit + new.hours '.
		'WHERE id = (SELECT idUser FROM activities WHERE id = new.idActivity); '.
		'UPDATE profiles SET credit = credit - new.hours '.
		'WHERE id = new.idUser; '.    
        'END IF; '.
        'END ');

        $this->db->query('CREATE TRIGGER after_requests_insert AFTER INSERT ON requests '.
        'FOR EACH ROW '.
        'BEGIN '.
        'IF new.idState = \'F\' THEN '.
		'UPDATE profiles SET credit = credit + new.hours '.
		'WHERE id = (SELECT idUser FROM activities WHERE id = new.idActivity); '.
		'UPDATE profiles SET credit = credit - new.hours '.
		'WHERE id = new.idUser; '.    
        'END IF; '.
        'END ');

        $seeder = \Config\Database::seeder();
		$seeder->call('RequestsSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('requests');
    }
}
