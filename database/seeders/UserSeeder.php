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
        // Utente admin principale
        User::factory()->create([
            'name' => 'Admin AtelierEuropeo',
            'email' => 'admin@atelier.it',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Utente registrato di test
        User::factory()->create([
            'name' => 'Marco Esempio',
            'email' => 'user@atelier.it',
            'password' => Hash::make('password'),
            'role' => 'registered_user'
        ]);

        // Secondo admin per testing
        User::factory()->create([
            'name' => 'Giulia Amministratore',
            'email' => 'giulia.admin@atelier.it',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Utenti registrati con nomi italiani
        User::factory()
            ->italian()
            ->count(15)
            ->create();

        // Alcuni utenti con email verificata più recentemente
        User::factory()
            ->count(8)
            ->create([
                'email_verified_at' => now()->subDays(rand(1, 30)),
            ]);

        // Alcuni utenti non verificati
        User::factory()
            ->unverified()
            ->count(3)
            ->create();
            
        $this->command->info('Created ' . User::count() . ' users total');
    }
}
