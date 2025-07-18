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
                'name' => 'Admin Progetti',
                'email' => 'admin.progetti@atelier.it'
            ]);
            $projectAdmins = collect([$admin]);
        }

        $categories = Category::all();
        $associations = Association::all();

        // Progetti con dati realistici e titoli specifici
        $projectsData = [
            [
                'title' => 'Green Cities - Sostenibilità Urbana',
                'sum_description' => 'Progetto di volontariato per promuovere la sostenibilità nelle città europee attraverso azioni concrete e sensibilizzazione.',
                'full_description' => 'Il progetto Green Cities mira a creare consapevolezza sui problemi ambientali urbani e a implementare soluzioni sostenibili. I partecipanti lavoreranno su iniziative di economia circolare, gestione dei rifiuti, mobilità sostenibile e creazione di spazi verdi urbani. Attraverso workshop, eventi pubblici e azioni dirette, contribuiranno a rendere le città più vivibili e sostenibili.',
                'requirements' => 'Età 18-30 anni, interesse per tematiche ambientali, conoscenza base inglese, motivazione nel volontariato ambientale.',
                'travel_conditions' => 'Viaggio rimborsato fino a 275€, alloggio condiviso, vitto e pocket money 150€/mese, assicurazione sanitaria inclusa.',
                'location' => 'Milano, Italia',
                'requested_people' => 8,
                'status' => 'published'
            ],
            [
                'title' => 'Digital Bridge - Inclusione Digitale',
                'sum_description' => 'Aiutare gli anziani e le persone vulnerabili ad acquisire competenze digitali per ridurre il divario tecnologico.',
                'full_description' => 'Digital Bridge è un progetto di solidarietà che si concentra sull\'inclusione digitale degli anziani e delle fasce vulnerabili della popolazione. I volontari organizzeranno corsi di alfabetizzazione digitale, supporteranno l\'uso di dispositivi tecnologici e creeranno materiali didattici accessibili. L\'obiettivo è ridurre l\'isolamento sociale attraverso la tecnologia.',
                'requirements' => 'Competenze informatiche di base, pazienza e capacità didattiche, conoscenza di una lingua locale, esperienza con persone anziane preferibile.',
                'travel_conditions' => 'Rimborso viaggio 100% fino a 180€, sistemazione in famiglia ospitante, tre pasti al giorno, trasporti locali coperti.',
                'location' => 'Barcelona, Spagna',
                'requested_people' => 6,
                'status' => 'published'
            ],
            [
                'title' => 'Cultural Heritage Preservation',
                'sum_description' => 'Preservazione e valorizzazione del patrimonio culturale europeo attraverso attività di catalogazione e restauro.',
                'full_description' => 'Questo progetto si dedica alla preservazione del ricco patrimonio culturale europeo. I partecipanti lavoreranno con musei locali, biblioteche e siti storici per catalogare manufatti, partecipare a attività di restauro e creare contenuti digitali per la promozione culturale. Un\'opportunità unica per immergersi nella storia e cultura locale mentre si contribuisce alla sua preservazione.',
                'requirements' => 'Interesse per storia e cultura, precisione nel lavoro di catalogazione, conoscenze base di fotografia digitale, flessibilità oraria.',
                'travel_conditions' => 'Viaggio coperto parzialmente (70%), vitto e alloggio completamente coperti, attività culturali incluse nel programma.',
                'location' => 'Praga, Repubblica Ceca',
                'requested_people' => 5,
                'status' => 'published'
            ],
            [
                'title' => 'Youth Innovation Lab',
                'sum_description' => 'Laboratorio di innovazione per giovani europei focalizzato su soluzioni tecnologiche per problemi sociali.',
                'full_description' => 'Innovation Lab è un progetto di formazione che riunisce giovani innovatori da tutta Europa per sviluppare soluzioni tecnologiche a problemi sociali locali. Attraverso hackathon, workshop di design thinking e mentoring con esperti, i partecipanti creeranno prototipi di app e servizi digitali per migliorare la qualità della vita nelle comunità locali.',
                'requirements' => 'Età 18-25 anni, competenze tecniche base (programmazione/design), creatività e problem-solving, conoscenza intermedia inglese.',
                'travel_conditions' => 'Tutti i costi coperti dall\'organizzazione, alloggio in camera doppia, supporto linguistico durante tutto il periodo.',
                'location' => 'Amsterdam, Paesi Bassi',
                'requested_people' => 12,
                'status' => 'published'
            ],
            [
                'title' => 'Community Sports Integration',
                'sum_description' => 'Promozione dell\'integrazione sociale attraverso lo sport in comunità multiculturali.',
                'full_description' => 'Un progetto che utilizza lo sport come strumento di integrazione e coesione sociale. I volontari organizzeranno tornei multiculturali, corsi di sport per bambini e adulti, e eventi sportivi inclusivi. L\'obiettivo è abbattere le barriere culturali e linguistiche attraverso l\'universalità del linguaggio sportivo.',
                'requirements' => 'Passione per lo sport, esperienza in organizzazione eventi sportivi preferibile, capacità di lavorare con gruppi diversi, energia e dinamismo.',
                'travel_conditions' => 'Rimborso viaggio parziale, alloggio in struttura condivisa, indennità giornaliera 8€, certificato Youthpass.',
                'location' => 'Berlino, Germania',
                'requested_people' => 10,
                'status' => 'published'
            ]
        ];

        // Crea progetti con dati specifici
        foreach ($projectsData as $index => $projectData) {
            $category = $categories->isNotEmpty() ? $categories->random() : null;
            $association = $associations->isNotEmpty() ? $associations->random() : null;
            
            $startDate = now()->addDays(rand(15, 90));
            $duration = $this->getDurationByCategory($category);
            $endDate = (clone $startDate)->addDays($duration);
            $expireDate = (clone $startDate)->subDays(rand(7, 21));
            
            Project::create(array_merge($projectData, [
                'user_id' => $projectAdmins->random()->id,
                'category_id' => $category?->id,
                'association_id' => $association?->id,
                'image_path' => 'img/projects/default.png',
                'start_date' => $startDate,
                'end_date' => $endDate,
                'expire_date' => $expireDate,
            ]));
        }

        // Crea alcuni progetti completati per il portfolio
        Project::factory()
            ->completed()
            ->count(8)
            ->create([
                'user_id' => fn() => $projectAdmins->random()->id,
                'category_id' => fn() => $categories->isNotEmpty() ? $categories->random()->id : null,
                'association_id' => fn() => $associations->isNotEmpty() ? $associations->random()->id : null,
            ]);

        // Crea alcuni progetti in bozza
        Project::factory()
            ->count(5)
            ->create([
                'status' => 'draft',
                'user_id' => fn() => $projectAdmins->random()->id,
                'category_id' => fn() => $categories->isNotEmpty() ? $categories->random()->id : null,
                'association_id' => fn() => $associations->isNotEmpty() ? $associations->random()->id : null,
            ]);

        // Crea progetti aggiuntivi casuali
        Project::factory()
            ->published()
            ->count(10)
            ->create([
                'user_id' => fn() => $projectAdmins->random()->id,
                'category_id' => fn() => $categories->isNotEmpty() ? $categories->random()->id : null,
                'association_id' => fn() => $associations->isNotEmpty() ? $associations->random()->id : null,
            ]);
            
        $this->command->info('Created ' . Project::count() . ' projects total');
        $this->command->info('- Published: ' . Project::where('status', 'published')->count());
        $this->command->info('- Draft: ' . Project::where('status', 'draft')->count());
        $this->command->info('- Completed: ' . Project::where('status', 'completed')->count());
    }
    
    /**
     * Get duration in days based on category.
     */
    private function getDurationByCategory($category): int
    {
        if (!$category) {
            return rand(14, 60);
        }
        
        return match($category->tag) {
            'ESC' => rand(14, 365), // European Solidarity Corps (2 settimane - 12 mesi)
            'YTH' => rand(5, 21),   // Youth Programs (5-21 giorni)
            'TRG' => rand(2, 10),   // Training (2-10 giorni)
            default => rand(7, 30), // Durata standard
        };
    }
}
