<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Association;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni utenti admin per collegarli ai progetti
        $projectAdmins = User::where('role', User::ROLE_PROJECT_ADMIN)
            ->orWhere('role', User::ROLE_SUPER_ADMIN)
            ->get();

        if ($projectAdmins->isEmpty()) {
            // Crea almeno un admin se non esiste
            $admin = User::factory()->create([
                'role' => User::ROLE_PROJECT_ADMIN,
                'name' => 'Admin Progetti',
                'email' => 'admin.progetti@esempio.com'
            ]);
            $projectAdmins = collect([$admin]);
        }

        $categories = Category::all();
        $associations = Association::all();

        // Crea 20 progetti di esempio
        for ($i = 0; $i < 20; $i++) {
            Project::create([
                'title' => 'Progetto di esempio ' . ($i + 1),
                'user_id' => $projectAdmins->random()->id,
                'category_id' => $categories->isEmpty() ? null : $categories->random()->id,
                'association_id' => $associations->isEmpty() ? null : $associations->random()->id,
                'status' => ['draft', 'published', 'archived'][rand(0, 2)],
                'requested_people' => rand(1, 10),
                'location' => ['Milano', 'Roma', 'Brescia', 'Torino'][rand(0, 3)],
                'start_date' => now()->addDays(rand(10, 30)),
                'end_date' => now()->addDays(rand(60, 90)),
                'expire_date' => now()->addDays(rand(5, 10)),
                'sum_description' => 'Breve descrizione del progetto ' . ($i + 1),
                'full_description' => 'Descrizione completa del progetto di esempio numero ' . ($i + 1),
                'requirements' => 'Requisiti per partecipare al progetto ' . ($i + 1),
                'travel_conditions' => 'Condizioni di viaggio per il progetto ' . ($i + 1),
            ]);
        }
    }
}
