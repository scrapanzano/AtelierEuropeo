<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Admin fissi (credenziali certe per il testing) ----
        User::factory()->create([
            'name'     => 'Admin AtelierEuropeo',
            'email'    => 'admin@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
        User::factory()->create([
            'name'     => 'Giulia Amministratore',
            'email'    => 'giulia.admin@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
        User::factory()->create([
            'name'     => 'Roberto Ferretti',
            'email'    => 'roberto.admin@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // ---- Utenti registrati fissi (credenziali certe per il testing) ----
        User::factory()->create([
            'name'     => 'Marco Esposito',
            'email'    => 'user@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'registered_user',
        ]);
        User::factory()->create([
            'name'     => 'Chiara Romano',
            'email'    => 'chiara.romano@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'registered_user',
        ]);
        User::factory()->create([
            'name'     => 'Luca Moretti',
            'email'    => 'luca.moretti@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'registered_user',
        ]);
        User::factory()->create([
            'name'     => 'Sofia Bianchi',
            'email'    => 'sofia.bianchi@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'registered_user',
        ]);
        User::factory()->create([
            'name'     => 'Andrea Conti',
            'email'    => 'andrea.conti@atelier.it',
            'password' => Hash::make('password'),
            'role'     => 'registered_user',
        ]);

        // ---- Utenti casuali con nomi italiani ----
        User::factory()->italian()->count(20)->create();

        // ---- Qualche utente non verificato ----
        User::factory()->unverified()->count(4)->create();

        $this->command->info('Creati ' . User::count() . ' utenti totali');
        $this->command->info('- Admin: '             . User::where('role', 'admin')->count());
        $this->command->info('- Utenti registrati: ' . User::where('role', 'registered_user')->count());
    }
}
