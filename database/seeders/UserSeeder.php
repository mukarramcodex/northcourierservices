<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::insert([
            [
                'name' => 'Admin',
                'role' => 'admin',
                'username' => 'ncsadmin',
                'email' => 'admin@northcourierservices.pk',
                'password' => bcrypt('Admin@123.456')
            ],
            [
                'name' => 'Manager',
                'role' => 'manager',
                'username' => 'ncsmanager',
                'email' => 'manager@northcourierservices.pk',
                'password' => bcrypt('Manager@123.456')
            ],
            [
                'name' => 'Staff',
                'role' => 'staff',
                'username' => 'ncsstaff',
                'email' => 'staff@northcourierservices.pk',
                'password' => bcrypt('Staff@123.456')
            ],
        ]);
    }
}
