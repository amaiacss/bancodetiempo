<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Activities extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255
			),
            'description' => array(
                'type'       => 'TEXT',
                'constraint' => 20                
			),
            'picture' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255
			),           
            'date' => array(
                'type'    => 'DATETIME',                
			),
            'idCategory' => [
				'type'           => 'INT',
                'constraint'     => 2                
            ],
            'idUser' => array(
                'type'           => 'INT',
                'constraint'     => 11              
            ),
           
			'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('idCategory', 'categories', 'id');
        $this->forge->addForeignKey('idUser', 'users', 'id');
        $this->forge->createTable('activities');

    }

    public function down()
    {
        $this->forge->dropTable('activities');
    }
}
