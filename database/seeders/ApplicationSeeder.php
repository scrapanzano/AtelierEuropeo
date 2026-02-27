<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $registeredUsers = User::where('role', 'registered_user')->get();
        $projects        = Project::all();

        if ($registeredUsers->isEmpty() || $projects->isEmpty()) {
            $this->command->warn('Nessun utente o progetto trovato. Eseguire prima UserSeeder e ProjectSeeder.');
            return;
        }

        $existing = collect();

        $createUnique = function ($factory, int $maxTries = 12) use (&$existing, $registeredUsers, $projects) {
            for ($i = 0; $i < $maxTries; $i++) {
                $userId  = $registeredUsers->random()->id;
                $project = $projects->random();
                $key     = "{$userId}_{$project->id}";

                if (!$existing->contains($key)) {
                    $existing->push($key);
                    return $factory->forProject($project)->create(['user_id' => $userId]);
                }
            }
            return null;
        };

        // Ogni utente ha almeno una candidatura
        foreach ($registeredUsers as $user) {
            $project = $projects->random();
            $key     = "{$user->id}_{$project->id}";
            if (!$existing->contains($key)) {
                $existing->push($key);
                Application::factory()->forProject($project)->create(['user_id' => $user->id]);
            }
        }

        // Candidature approvate
        foreach (range(1, 25) as $_) {
            $createUnique(Application::factory()->approved());
        }
        // Candidature rifiutate
        foreach (range(1, 20) as $_) {
            $createUnique(Application::factory()->rejected());
        }
        // Candidature in attesa
        foreach (range(1, 30) as $_) {
            $createUnique(Application::factory()->pending());
        }
        // Candidature casuali aggiuntive
        foreach (range(1, 25) as $_) {
            $createUnique(Application::factory());
        }

        $this->command->info('Create ' . Application::count() . ' candidature totali');
        $this->command->info('- Approvate: ' . Application::where('status', 'approved')->count());
        $this->command->info('- Rifiutate: ' . Application::where('status', 'rejected')->count());
        $this->command->info('- In attesa: ' . Application::where('status', 'pending')->count());
    }
}
