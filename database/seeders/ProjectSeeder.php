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
        $projectAdmins = User::where('role', 'admin')->get();

        if ($projectAdmins->isEmpty()) {
            // Crea almeno un admin se non esiste
            $admin = User::factory()->create([
                'role' => 'admin',
                'name' => 'Admin',
                'email' => 'admin.progetti@esempio.com'
            ]);
            $projectAdmins = collect([$admin]);
        }

        $categories = Category::all();
        $associations = Association::all();

        // Crea 20 progetti di esempio
        for ($i = 0; $i < 20; $i++) {
            // Seleziona prima una categoria casuale
            $category = $categories->isEmpty() ? null : $categories->random();

            // Determina le date di inizio e fine in base alla categoria
            $startDate = now()->addDays(rand(10, 30));
            $endDate = null;

            if ($category) {
                switch ($category->tag) {
                    case 'ESC': // European Solidarity Corps (2 settimane - 12 mesi)
                        // Da 14 giorni a 365 giorni
                        $endDate = clone $startDate;
                        $endDate->addDays(rand(14, 365));
                        break;

                    case 'YTH': // Youth Programs (5-21 giorni)
                        $endDate = clone $startDate;
                        $endDate->addDays(rand(5, 21));
                        break;

                    case 'TRG': // Training (2-10 giorni)
                        $endDate = clone $startDate;
                        $endDate->addDays(rand(2, 10));
                        break;

                    default:
                        // Categoria sconosciuta, usa una durata standard
                        $endDate = clone $startDate;
                        $endDate->addDays(rand(5, 30));
                }
            } else {
                // Nessuna categoria, usa una durata standard
                $endDate = $startDate->copy()->addDays(rand(5, 30));
            }

            // Calcola la data di scadenza come un numero casuale di giorni prima della data di inizio
            $expireDaysBefore = rand(14, 30); // La scadenza sarà da 14 a 30 giorni prima dell'inizio
            $expireDate = (clone $startDate)->subDays($expireDaysBefore);

            Project::create([
                'title' => 'Progetto di esempio ' . ($i + 1),
                'user_id' => $projectAdmins->random()->id,
                'category_id' => $category ? $category->id : null,
                'association_id' => $associations->isEmpty() ? null : $associations->random()->id,
                'image_path' => 'img/projects/default.png',
                'status' => ['draft', 'published', 'completed'][rand(0, 2)],
                'requested_people' => rand(1, 10),
                'location' => ['Milano', 'Roma', 'Brescia', 'Torino'][rand(0, 3)],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'expire_date' => $expireDate,
                'sum_description' => 'Breve descrizione del progetto ' . ($i + 1),
                'full_description' => 'Descrizione completa del progetto di esempio numero ' . ($i + 1),
                'requirements' => 'Requisiti per partecipare al progetto ' . ($i + 1),
                'travel_conditions' => 'Condizioni di viaggio per il progetto ' . ($i + 1),
            ]);
        }
    }
}
