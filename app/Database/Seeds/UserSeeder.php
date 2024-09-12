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
        $insertdata['email'] = 'admin@mail.com';
        $insertdata['password'] = password_hash('password', PASSWORD_BCRYPT);

        $admin->insert($insertdata);
    }
}
