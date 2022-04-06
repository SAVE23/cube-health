<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => NULL
            ],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
                'default' => NULL
			],
			'mobile' => [
				'type' => 'VARCHAR',
				'constraint' => '25',
                'default' => NULL
			],
			'mobile_otp' => [
				'type' => 'VARCHAR',
				'constraint' => '125',
                'default' => NULL
			],
            'role' => [
				'type' => 'VARCHAR',
				'constraint' => '25',
                'default' => NULL
			],
            'access' => [
				'type' => 'tinyint',
				'constraint' => '1',
                'default' => '1'
			],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
