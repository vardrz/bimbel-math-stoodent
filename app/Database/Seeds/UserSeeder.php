<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = new UserModel();

        $insertdata['name'] = 'Admin';
        $insertdata['username'] = 'mathstoodent';
        $insertdata['password'] = password_hash('password', PASSWORD_BCRYPT);
        $insertdata['role'] = 'admin';

        $admin->insert($insertdata);
    }
}
