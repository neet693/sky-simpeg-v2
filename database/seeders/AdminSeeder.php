<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'employee_number' => 'sky-001',
            'email' => 'admin@sky.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rusakdeh'),
            'role' => 'admin',
            'birth_date' => '1999-07-19',
            'phone_number' => '082350496224',
            'address' => 'Jl. L. L. R. E. Martadinata No. 71A - 73',
        ]);
    }
}
