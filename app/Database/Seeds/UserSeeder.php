<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('user')->insert($data);
    }
}
