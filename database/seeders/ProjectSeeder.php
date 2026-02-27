<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Association;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    private function img(int $n): string
    {
        $ext = $n === 26 ? '.jpg' : '.png';
        return 'img/projects/default' . $n . $ext;
    }

    public function run(): void
    {
        $admins = User::where('role', 'admin')->get();
        if ($admins->isEmpty()) {
            $admin  = User::factory()->create(['role' => 'admin', 'name' => 'Admin Principale', 'email' => 'admin.progetti@atelier.it']);
            $admins = collect([$admin]);
        }

        $cats  = Category::all()->keyBy('tag');
        $assoc = Association::all();

        $esc = $cats->get('ESC');
        $yth = $cats->get('YTH');
        $trg = $cats->get('TRG');

        /* ----------------------------------------------------------------
         | COMPLETATI 2024
         * -------------------------------------------------------------- */
        $completati2024 = [
            [
                'title'            => 'Ecosistema Urbano – Riqualifica Spazi Pubblici',
                'sum_description'  => 'Volontariato ESC per la riqualificazione di parchi e aree verdi a Milano con residenti e volontari europei.',
                'full_description' => 'I volontari hanno collaborato con il Municipio di Milano per riqualificare tre parchi periferici. Le attività hanno incluso pulizia di aree abbandonate, piantumazione di alberi da frutto, creazione di orti comunitari e laboratori di educazione ambientale per le scuole primarie. Il progetto ha coinvolto oltre 500 residenti nelle attività di co-progettazione.',
                'requirements'     => 'Età 18–30 anni. Interesse per tematiche ambientali e lavori manuali all\'aperto. Conoscenza base dell\'inglese. Spirito di squadra.',
                'travel_conditions'=> 'Viaggio rimborsato fino a 275€. Alloggio condiviso. Vitto e pocket money 150€/mese. Assicurazione sanitaria inclusa.',
                'location'         => 'Milano, Italia',
                'requested_people' => 8,
                'start_date'       => Carbon::create(2024, 2, 5),
                'end_date'         => Carbon::create(2024, 4, 30),
                'expire_date'      => Carbon::create(2024, 1, 20),
                'status'           => 'completed',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(1),
            ],
            [
                'title'            => 'Mani Solidali – Assistenza Anziani e Fragilità',
                'sum_description'  => 'Progetto ESC di supporto agli anziani non autosufficienti a Napoli, con attività domiciliari e ricreative.',
                'full_description' => 'Il progetto ha affiancato il personale delle strutture per anziani del Comune di Napoli. I volontari hanno organizzato laboratori creativi, sessioni di lettura, escursioni e attività digitali per ridurre l\'isolamento degli ospiti. Sono state realizzate anche visite a domicilio per anziani non autosufficienti.',
                'requirements'     => 'Empatia e capacità relazionali. Pazienza e attitudine al lavoro con persone anziane. Buona conoscenza dell\'italiano.',
                'travel_conditions'=> 'Rimborso viaggio al 100% fino a 180€. Alloggio in struttura convenzionata. Tre pasti al giorno inclusi.',
                'location'         => 'Napoli, Italia',
                'requested_people' => 6,
                'start_date'       => Carbon::create(2024, 4, 1),
                'end_date'         => Carbon::create(2024, 9, 30),
                'expire_date'      => Carbon::create(2024, 3, 15),
                'status'           => 'completed',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(2),
            ],
            [
                'title'            => 'Euro Youth Dialogue – Voce ai Giovani',
                'sum_description'  => 'Scambio giovanile europeo su democrazia partecipativa e diritti giovanili a Berlino.',
                'full_description' => 'Giovani da 8 paesi europei si sono incontrati per 10 giorni per discutere di partecipazione giovanile nelle istituzioni, diritto al voto e advocacy. Il programma includeva simulazioni del Parlamento Europeo, panel con politici locali e la redazione di un manifesto condiviso.',
                'requirements'     => 'Età 16–25 anni. Interesse per politica e diritti giovanili. Inglese intermedio. Disponibilità per tutti i 10 giorni.',
                'travel_conditions'=> 'Tutti i costi coperti. Alloggio in ostello. Supporto linguistico durante tutto il programma.',
                'location'         => 'Berlino, Germania',
                'requested_people' => 5,
                'start_date'       => Carbon::create(2024, 7, 8),
                'end_date'         => Carbon::create(2024, 7, 18),
                'expire_date'      => Carbon::create(2024, 6, 20),
                'status'           => 'completed',
                'category_id'      => $yth?->id,
                'image_path'       => $this->img(3),
            ],
            [
                'title'            => 'Project Management per ONG e Associazioni',
                'sum_description'  => 'Corso di formazione intensivo per operatori del terzo settore sulla gestione dei progetti europei.',
                'full_description' => 'Cinque giorni di formazione a Roma dedicati agli strumenti di project management per il nonprofit: pianificazione, budgeting, reportistica Erasmus+ e valutazione dell\'impatto. I partecipanti hanno poi sviluppato un piano di progetto simulato su casi reali.',
                'requirements'     => 'Operatori del terzo settore, educatori, coordinatori di volontariato. Esperienza minima di 1 anno nel settore. Ottimo italiano.',
                'travel_conditions'=> 'Quota zero per candidati selezionati. Vitto e alloggio inclusi. Rimborso viaggio parziale fino a 100€.',
                'location'         => 'Roma, Italia',
                'requested_people' => 20,
                'start_date'       => Carbon::create(2024, 10, 14),
                'end_date'         => Carbon::create(2024, 10, 18),
                'expire_date'      => Carbon::create(2024, 9, 30),
                'status'           => 'completed',
                'category_id'      => $trg?->id,
                'image_path'       => $this->img(4),
            ],
            [
                'title'            => 'Culture Mix Camp – Scambio tra Culture',
                'sum_description'  => 'Campo estivo multiculturale a Barcellona con 40 giovani europei e attività artistiche e interculturali.',
                'full_description' => 'Due settimane di convivenza tra 40 giovani da 10 paesi. Il programma ha unito laboratori di danza, musica, pittura e fotografia con sessioni di dialogo interculturale, visite al patrimonio locale e un festival finale aperto alla cittadinanza di Barcellona.',
                'requirements'     => 'Età 18–30 anni. Passione per le arti e la cultura. Apertura mentale. Non è necessaria esperienza artistica pregressa.',
                'travel_conditions'=> 'Vitto e alloggio completamente coperti. Rimborso viaggio fino a 275€. Pocket money giornaliero 10€.',
                'location'         => 'Barcelona, Spagna',
                'requested_people' => 10,
                'start_date'       => Carbon::create(2024, 8, 5),
                'end_date'         => Carbon::create(2024, 8, 19),
                'expire_date'      => Carbon::create(2024, 7, 15),
                'status'           => 'completed',
                'category_id'      => $yth?->id,
                'image_path'       => $this->img(5),
            ],
        ];

        /* ----------------------------------------------------------------
         | COMPLETATI 2025
         * -------------------------------------------------------------- */
        $completati2025 = [
            [
                'title'            => 'Orto Sociale Comunitario',
                'sum_description'  => 'Progetto ESC per la creazione di orti urbani condivisi a Bologna con focus su agricoltura biologica.',
                'full_description' => 'Il progetto ha trasformato quattro aree dismesse di Bologna in orti comunitari accessibili ai residenti. I volontari hanno collaborato con associazioni locali per formare i cittadini su coltivazione biologica, compostaggio e riutilizzo dell\'acqua. Al termine, gli orti sono stati affidati alle comunità di abitanti.',
                'requirements'     => 'Età 18–30 anni. Interesse per ambiente e temi alimentari. Predisposizione al lavoro manuale all\'aperto.',
                'travel_conditions'=> 'Alloggio in appartamento condiviso. Vitto 18€/giorno. Trasporti locali coperti. Rimborso viaggio fino a 275€.',
                'location'         => 'Bologna, Italia',
                'requested_people' => 7,
                'start_date'       => Carbon::create(2025, 3, 10),
                'end_date'         => Carbon::create(2025, 8, 31),
                'expire_date'      => Carbon::create(2025, 2, 25),
                'status'           => 'completed',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(6),
            ],
            [
                'title'            => 'Competenze Digitali per Operatori Sociali',
                'sum_description'  => 'Training di 7 giorni a Milano sulle tecnologie digitali applicate al lavoro sociale e all\'inclusione.',
                'full_description' => 'Workshop intensivo per educatori e operatori sociali su: gestione social media per ONG, strumenti di collaborazione online, protezione dati (GDPR), accessibilità digitale e piattaforme per la gestione di volontari.',
                'requirements'     => 'Operatori sociali, educatori, animatori giovanili. Conoscenza base del computer. Motivazione a sperimentare nuovi strumenti.',
                'travel_conditions'=> 'Alloggio in hotel 3★ in camera singola. Tutti i pasti inclusi. Rimborso viaggio fino a 150€.',
                'location'         => 'Milano, Italia',
                'requested_people' => 18,
                'start_date'       => Carbon::create(2025, 4, 7),
                'end_date'         => Carbon::create(2025, 4, 13),
                'expire_date'      => Carbon::create(2025, 3, 24),
                'status'           => 'completed',
                'category_id'      => $trg?->id,
                'image_path'       => $this->img(7),
            ],
            [
                'title'            => 'EcoYouth Camp – Natura e Sostenibilità',
                'sum_description'  => 'Campo giovanile internazionale in Slovenia dedicato alla sostenibilità ambientale e alla vita in natura.',
                'full_description' => 'Giovani da 12 paesi europei hanno trascorso tre settimane immersi nella natura slovena esplorando ecologia, permacultura, zero waste e cambiamenti climatici. Il programma alternava attività outdoor, laboratori pratici e momenti di riflessione collettiva.',
                'requirements'     => 'Età 18–26 anni. Interesse per l\'ecologia. Spirito d\'avventura. Conoscenza base dell\'inglese.',
                'travel_conditions'=> 'Vitto e alloggio 100% coperti. Rimborso viaggio fino a 275€. Assicurazione sanitaria inclusa. Youthpass rilasciato.',
                'location'         => 'Lubiana, Slovenia',
                'requested_people' => 7,
                'start_date'       => Carbon::create(2025, 7, 5),
                'end_date'         => Carbon::create(2025, 7, 26),
                'expire_date'      => Carbon::create(2025, 6, 15),
                'status'           => 'completed',
                'category_id'      => $yth?->id,
                'image_path'       => $this->img(8),
            ],
            [
                'title'            => 'Lingue e Frontiere – Italiano per Migranti',
                'sum_description'  => 'Servizio ESC di supporto all\'apprendimento dell\'italiano per rifugiati e richiedenti asilo a Torino.',
                'full_description' => 'I volontari hanno affiancato gli insegnanti dei CPIA di Torino in corsi di italiano L2 per rifugiati e migranti. Oltre alle lezioni, hanno organizzato laboratori culturali e uscite sul territorio per favorire l\'integrazione.',
                'requirements'     => 'Età 18–30 anni. Interesse per l\'insegnamento e l\'integrazione. Buone capacità comunicative. Conoscenza di inglese o francese utile.',
                'travel_conditions'=> 'Alloggio in struttura convenzionata. Pocket money 155€/mese. Rimborso viaggio fino a 275€. Formazione iniziale garantita.',
                'location'         => 'Torino, Italia',
                'requested_people' => 4,
                'start_date'       => Carbon::create(2025, 9, 1),
                'end_date'         => Carbon::create(2025, 12, 20),
                'expire_date'      => Carbon::create(2025, 8, 10),
                'status'           => 'completed',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(9),
            ],
            [
                'title'            => 'Youth Media Lab – Comunicazione Creativa',
                'sum_description'  => 'Laboratorio europeo su video, podcast e storytelling per il cambiamento sociale, a Varsavia.',
                'full_description' => 'Trenta giovani europei hanno acquisito competenze di produzione multimediale come strumento di advocacy. I partecipanti hanno realizzato mini-documentari, episodi podcast e campagne social su discriminazione, sostenibilità e diritti umani.',
                'requirements'     => 'Età 18–26 anni. Interesse per comunicazione e media. Conoscenza di app di editing (anche base). Inglese intermedio.',
                'travel_conditions'=> 'Alloggio, vitto e attività incluse. Rimborso viaggio standard UE. Youthpass al termine.',
                'location'         => 'Varsavia, Polonia',
                'requested_people' => 6,
                'start_date'       => Carbon::create(2025, 11, 3),
                'end_date'         => Carbon::create(2025, 11, 14),
                'expire_date'      => Carbon::create(2025, 10, 12),
                'status'           => 'completed',
                'category_id'      => $yth?->id,
                'image_path'       => $this->img(10),
            ],
        ];

        /* ----------------------------------------------------------------
         | PUBBLICATI 2026 (candidature aperte / prossimamente)
         * -------------------------------------------------------------- */
        $pubblicati2026 = [
            [
                'title'            => 'Verde in Città – Urban Gardening',
                'sum_description'  => 'Progetto ESC per la creazione di giardini comunitari e percorsi di educazione ambientale a Firenze.',
                'full_description' => 'I volontari europei parteciperanno alla creazione e gestione di spazi verdi urbani in quattro quartieri di Firenze. Le attività comprendono progettazione partecipata di giardini, cura quotidiana degli spazi, laboratori per bambini e adulti, e produzione di materiali educativi sull\'ecologia urbana.',
                'requirements'     => 'Età 18–30 anni. Passione per il verde e il giardinaggio. Attitudine al lavoro di gruppo. Conoscenza base dell\'inglese.',
                'travel_conditions'=> 'Viaggio rimborsato fino a 275€. Alloggio condiviso in appartamento. Vitto 18€/giorno. Assicurazione sanitaria inclusa.',
                'location'         => 'Firenze, Italia',
                'requested_people' => 6,
                'start_date'       => Carbon::create(2026, 3, 16),
                'end_date'         => Carbon::create(2026, 9, 15),
                'expire_date'      => Carbon::create(2026, 2, 28),
                'status'           => 'published',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(11),
            ],
            [
                'title'            => 'Digital Heritage – Patrimonio nell\'Era Digitale',
                'sum_description'  => 'Digitalizzazione e valorizzazione di archivi storici a Palermo con tecnologie 3D e realtà virtuale.',
                'full_description' => 'I volontari collaboreranno con la Soprintendenza di Palermo per digitalizzare manoscritti, fotografie storiche e manufatti artistici. Verranno usate tecnologie di scansione 3D e VR per creare esperienze immersive del patrimonio culturale siciliano accessibili anche alla diaspora.',
                'requirements'     => 'Interesse per storia dell\'arte. Competenze informatiche. Precisione e attenzione al dettaglio. Inglese intermedio.',
                'travel_conditions'=> 'Alloggio condiviso. Pocket money 155€/mese. Rimborso viaggio fino a 275€. Formazione tecnica iniziale garantita.',
                'location'         => 'Palermo, Italia',
                'requested_people' => 4,
                'start_date'       => Carbon::create(2026, 4, 1),
                'end_date'         => Carbon::create(2026, 10, 31),
                'expire_date'      => Carbon::create(2026, 3, 15),
                'status'           => 'published',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(12),
            ],
            [
                'title'            => 'ArtLink – Arte Giovanile Europea',
                'sum_description'  => 'Residenza artistica a Vienna: giovani europei da 8 nazioni creano insieme un\'opera collettiva itinerante.',
                'full_description' => 'ArtLink riunisce giovani creativi (pittori, scultori, performer, videoartisti) per 12 giorni a Vienna. Il risultato sarà una mostra itinerante e un catalogo digitale multilingue. Il progetto vuole valorizzare la diversità culturale europea come fonte di ispirazione artistica.',
                'requirements'     => 'Età 18–30 anni. Esperienza artistica in qualsiasi disciplina. Portfolio digitale richiesto. Inglese conversazionale.',
                'travel_conditions'=> 'Alloggio e vitto coperti. Rimborso viaggio UE standard. Materiali artistici forniti. Youthpass e certificato di partecipazione.',
                'location'         => 'Vienna, Austria',
                'requested_people' => 5,
                'start_date'       => Carbon::create(2026, 5, 18),
                'end_date'         => Carbon::create(2026, 5, 29),
                'expire_date'      => Carbon::create(2026, 4, 20),
                'status'           => 'published',
                'category_id'      => $yth?->id,
                'image_path'       => $this->img(13),
            ],
            [
                'title'            => 'Fundraising e Scrittura Progettuale Erasmus+',
                'sum_description'  => 'Formazione avanzata a Bruxelles per enti del terzo settore su come accedere ai fondi europei.',
                'full_description' => 'Sei giorni di formazione nel cuore delle istituzioni europee: navigare il portale della gioventù, costruire partenariati internazionali, scrivere candidature efficaci e gestire la rendicontazione finanziaria Erasmus+.',
                'requirements'     => 'Responsabili di progetto, coordinatori gioventù, direttori di ONG. Esperienza nel terzo settore. Inglese buono (B2).',
                'travel_conditions'=> 'Partecipazione gratuita per enti qualificati. Vitto e alloggio inclusi. Rimborso viaggio fino a 500€.',
                'location'         => 'Bruxelles, Belgio',
                'requested_people' => 15,
                'start_date'       => Carbon::create(2026, 6, 8),
                'end_date'         => Carbon::create(2026, 6, 13),
                'expire_date'      => Carbon::create(2026, 5, 15),
                'status'           => 'published',
                'category_id'      => $trg?->id,
                'image_path'       => $this->img(14),
            ],
            [
                'title'            => 'Cucina Solidale – Food Rescue e Redistribuzione',
                'sum_description'  => 'Progetto ESC di recupero alimentare e redistribuzione alle famiglie vulnerabili di Roma.',
                'full_description' => 'I volontari lavoreranno con il Banco Alimentare e mense sociali romane per recuperare eccedenze da supermercati e mercati, trasformarle in pasti e distribuirle a famiglie in difficoltà. Inclusi laboratori di cucina anti-spreco aperti alla cittadinanza.',
                'requirements'     => 'Età 18–30 anni. Disponibilità a orari flessibili (anche mattutini). Nessuna esperienza culinaria necessaria. Empatia.',
                'travel_conditions'=> 'Alloggio in struttura vicina alla sede. Pocket money 155€/mese. Rimborso viaggio fino a 275€.',
                'location'         => 'Roma, Italia',
                'requested_people' => 8,
                'start_date'       => Carbon::create(2026, 7, 1),
                'end_date'         => Carbon::create(2026, 12, 31),
                'expire_date'      => Carbon::create(2026, 6, 10),
                'status'           => 'published',
                'category_id'      => $esc?->id,
                'image_path'       => $this->img(15),
            ],
            [
                'title'            => 'Comunicazione Interculturale e Mediazione',
                'sum_description'  => 'Training residenziale a Budapest per operatori che lavorano con gruppi multiculturali.',
                'full_description' => 'Un percorso di 8 giorni sulle dinamiche della comunicazione interculturale, i pregiudizi inconsci, le tecniche di mediazione e la facilitazione di gruppi diversi. Metodi partecipativi, role play e simulazioni con casi reali tratti da contesti di volontariato europeo.',
                'requirements'     => 'Educatori, operatori sociali, animatori giovanili. Esperienza con gruppi internazionali preferibile. Inglese B1.',
                'travel_conditions'=> 'Vitto e alloggio completi. Rimborso viaggio fino a 275€. Certificato di partecipazione.',
                'location'         => 'Budapest, Ungheria',
                'requested_people' => 20,
                'start_date'       => Carbon::create(2026, 9, 14),
                'end_date'         => Carbon::create(2026, 9, 21),
                'expire_date'      => Carbon::create(2026, 8, 25),
                'status'           => 'published',
                'category_id'      => $trg?->id,
                'image_path'       => $this->img(16),
            ],
        ];

        $imgCounter = 17;
        foreach (array_merge($completati2024, $completati2025, $pubblicati2026) as $data) {
            $association = $assoc->isNotEmpty() ? $assoc->random() : null;
            Project::create(array_merge($data, [
                'user_id'        => $admins->random()->id,
                'association_id' => $association?->id,
            ]));
        }

        // Progetti casuali aggiuntivi
        Project::factory()->completed()->count(5)->create([
            'user_id'        => fn() => $admins->random()->id,
            'category_id'    => fn() => $cats->isNotEmpty()  ? $cats->random()->id  : null,
            'association_id' => fn() => $assoc->isNotEmpty() ? $assoc->random()->id : null,
        ]);
        Project::factory()->published()->count(7)->create([
            'user_id'        => fn() => $admins->random()->id,
            'category_id'    => fn() => $cats->isNotEmpty()  ? $cats->random()->id  : null,
            'association_id' => fn() => $assoc->isNotEmpty() ? $assoc->random()->id : null,
        ]);
        Project::factory()->count(4)->create([
            'status'         => 'draft',
            'user_id'        => fn() => $admins->random()->id,
            'category_id'    => fn() => $cats->isNotEmpty()  ? $cats->random()->id  : null,
            'association_id' => fn() => $assoc->isNotEmpty() ? $assoc->random()->id : null,
        ]);

        $this->command->info('Creati ' . Project::count() . ' progetti totali');
        $this->command->info('- Pubblicati: '  . Project::where('status', 'published')->count());
        $this->command->info('- Bozze: '       . Project::where('status', 'draft')->count());
        $this->command->info('- Completati: '  . Project::where('status', 'completed')->count());
    }
}
