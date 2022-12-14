<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'           => 'INT',
                'constraint'     => 11                
            ),
            'firstName' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ),
            'lastName' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ),
            'phone' => array(
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => true
            ),                  
            'aboutMe' => array(
                'type' => 'TEXT',
                'null' => true
            ),
            'picture' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ),
            'credit' => array(
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
                'default' => 0
            ),         
            'locationCode' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true
            ),        
			'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id', 'users',  'id');
        $this->forge->addForeignKey('locationCode', 'cities', 'code');
        $this->forge->createTable('profiles');

    }

    public function down()
    {
        $this->forge->dropTable('profiles');
    }
}
