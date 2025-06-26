<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@atelier.it',
            'password' => Hash::make('password'),
            'role' => 'project_admin'
        ]);

        User::factory()->create([
            'name' => 'Registered User',
            'email' => 'user@atelier.it',
            'password' => Hash::make('password'),
            'role' => 'registered_user'
        ]);
    }
}
