<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = $this->db->table('users');
        $demo = $users->where('username', 'demo')->get()->getRowArray();
        if ($demo === null) {
            $users->insert([
                'username' => 'demo',
                'full_name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } elseif (empty($demo['password'])) {
            $users->where('id', $demo['id'])->update(['password' => password_hash('password', PASSWORD_DEFAULT)]);
        }

        $tasks = $this->db->table('tasks');
        if ($tasks->countAllResults() === 0) {
            $tasks->insertBatch([
                ['title' => 'Review CodeIgniter project', 'status' => 'pending', 'task_date' => date('Y-m-d'), 'is_archived' => 0, 'created_at' => date('Y-m-d H:i:s')],
                ['title' => 'Submit TSA2 requirements', 'status' => 'in progress', 'task_date' => date('Y-m-d'), 'is_archived' => 0, 'created_at' => date('Y-m-d H:i:s')],
            ]);
        }
    }
}
