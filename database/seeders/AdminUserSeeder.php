<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'djabirtraore72@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
