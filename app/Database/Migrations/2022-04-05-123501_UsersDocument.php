<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersDocument extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'uid' => [
				'type' => 'INT',
				'constraint' => '25',
                'default' => NULL
			],
			'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => NULL
            ],
            'file_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => NULL
            ],
			'file_content' => [
                'type' => 'LONGBLOB',
                // 'constraint' => '200',
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
        $this->forge->createTable('users_document');
    }

    public function down()
    {
        $this->forge->dropTable('users_document');
    }
}
