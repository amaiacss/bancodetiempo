<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255
			),
            'username' => array(
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true
			),
            'pass' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255
			),
			'verificado' => array(
                'type'    => 'TINYINT',
                'default' => 0
			),
            'name' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ),
            'firstName' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ),
            'phone' => array(
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => true
            ),
            'about_me' => array(
                'type' => 'TEXT',
                'null' => true
            ),
            'activacion_codigo' => array(
                'type'       => 'VARCHAR',
				'constraint' => '255'
            ),
            'recuperacion_codigo' => array(
				'type'       => 'VARCHAR',
				'constraint' => '255',
                'null'       => true
            ),
			'created_at' => [ 'type' => 'DATETIME' ],
			'updated_at' => [ 'type' => 'DATETIME' ],
			'deleted_at' => [ 'type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
