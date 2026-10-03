<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksAndUsers extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('users')) {
            $this->forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'username' => ['type' => 'VARCHAR', 'constraint' => 50],
                'full_name' => ['type' => 'VARCHAR', 'constraint' => 100],
                'email' => ['type' => 'VARCHAR', 'constraint' => 150],
                'password' => ['type' => 'VARCHAR', 'constraint' => 255],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addUniqueKey('username');
            $this->forge->createTable('users');
        } elseif (! $this->db->fieldExists('password', 'users')) {
            $this->forge->addColumn('users', ['password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]]);
        }

        if (! $this->db->tableExists('tasks')) {
            $this->forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'title' => ['type' => 'VARCHAR', 'constraint' => 150],
                'status' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'pending'],
                'task_date' => ['type' => 'DATE'],
                'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('tasks');
        } elseif (! $this->db->fieldExists('is_archived', 'tasks')) {
            $this->forge->addColumn('tasks', ['is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0]]);
        }

        if ($this->db->tableExists('tasks') && ! $this->db->fieldExists('updated_at', 'tasks')) {
            $this->forge->addColumn('tasks', ['updated_at' => ['type' => 'DATETIME', 'null' => true]]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('tasks', true);
        $this->forge->dropTable('users', true);
    }
}
