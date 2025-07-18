<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registeredUsers = User::where('role', 'registered_user')->get();
        $projects = Project::all();
        
        if ($registeredUsers->isEmpty() || $projects->isEmpty()) {
            $this->command->warn('No users or projects found. Make sure UserSeeder and ProjectSeeder run first.');
            return;
        }
        
        $existingCombinations = collect();
        
        // Funzione helper per evitare duplicati
        $createUniqueApplication = function($factory, $maxAttempts = 10) use (&$existingCombinations, $registeredUsers, $projects) {
            for ($i = 0; $i < $maxAttempts; $i++) {
                $userId = $registeredUsers->random()->id;
                $project = $projects->random();
                $combination = "{$userId}_{$project->id}";
                
                if (!$existingCombinations->contains($combination)) {
                    $existingCombinations->push($combination);
                    return $factory->forProject($project)->create(['user_id' => $userId]);
                }
            }
            // Se non riusciamo a trovare una combinazione unica, saltiamo
            return null;
        };
        
        // Assicuriamoci che ogni utente abbia almeno una candidatura
        foreach ($registeredUsers->take(10) as $user) {
            $randomProject = $projects->random();
            $combination = "{$user->id}_{$randomProject->id}";
            
            if (!$existingCombinations->contains($combination)) {
                $existingCombinations->push($combination);
                Application::factory()
                    ->forProject($randomProject)
                    ->create(['user_id' => $user->id]);
            }
        }
        
        // Candidature approvate (20)
        foreach (range(1, 20) as $i) {
            $createUniqueApplication(Application::factory()->approved());
        }
            
        // Candidature rifiutate (15) 
        foreach (range(1, 15) as $i) {
            $createUniqueApplication(Application::factory()->rejected());
        }
            
        // Candidature in attesa (25)
        foreach (range(1, 25) as $i) {
            $createUniqueApplication(Application::factory()->pending());
        }
            
        // Alcune candidature casuali aggiuntive
        foreach (range(1, 30) as $i) {
            $createUniqueApplication(Application::factory());
        }
            
        $this->command->info('Created ' . Application::count() . ' applications total');
        $this->command->info('- Approved: ' . Application::where('status', 'approved')->count());
        $this->command->info('- Rejected: ' . Application::where('status', 'rejected')->count());
        $this->command->info('- Pending: ' . Application::where('status', 'pending')->count());
    }
}
