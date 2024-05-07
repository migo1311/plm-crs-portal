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
        User::create([
            'name' => 'TESTCOLLEGE',
            'email' => 'test.college@example.com',
            'password' => 'password',
            'role_id' => '3',
        ]);
        User::create([
            'name' => 'TESTFACULTY',
            'email' => 'test.faculty@example.com',
            'password' => 'password',
            'role_id' => '2',
        ]);
        User::create([
            'name' => 'ACORWIN61',
            'email' => 'gerald.baumbach@example.com',
            'password' => 'password',
            'role_id' => '2',
        ]);
        User::create([
            'name' => 'AABERNATHY76',
            'email' => 'edythe.daugherty@example.org',
            'password' => 'password',
            'role_id' => '2',
        ]);
        User::create([
            'name' => 'GCONNELLY38',
            'email' => 'vmcdermott@example.org',
            'password' => 'password',
            'role_id' => '2',
        ]);

    }
}
