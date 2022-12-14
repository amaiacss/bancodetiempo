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
            'date' => array(
                'type'       => 'DATETIME'                
			),
            'hours' => array(
                'type'       => 'INT',
                'constraint' => 2,
                'default' => 0              
			),
            'state' => array(
                'type'       => 'CHAR',
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
        $this->forge->createTable('requests');

    }

    public function down()
    {
        $this->forge->dropTable('requests');
    }
}
