<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'user_type' => 'a',
            'email' => 'a@dmin.id',
            'email_verified_at' => now(),
            'password' => Hash::make('adminPassword')
        ]);
    }
}
