<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Association;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $europeanCities = [
            'Milano, Italia', 'Roma, Italia', 'Napoli, Italia', 'Firenze, Italia',
            'Barcelona, Spagna', 'Madrid, Spagna', 'Valencia, Spagna',
            'Parigi, Francia', 'Lione, Francia', 'Marsiglia, Francia',
            'Berlino, Germania', 'Monaco, Germania', 'Amburgo, Germania',
            'Amsterdam, Paesi Bassi', 'Rotterdam, Paesi Bassi',
            'Vienna, Austria', 'Salisburgo, Austria',
            'Lisbona, Portogallo', 'Porto, Portogallo',
            'Praga, Repubblica Ceca', 'Budapest, Ungheria',
            'Varsavia, Polonia', 'Cracovia, Polonia',
            'Stoccolma, Svezia', 'Copenaghen, Danimarca'
        ];
        
        $projectTitles = [
            // ESC – Corpo Europeo di Solidarietà
            'Ecosistema Urbano – Riqualifica Spazi Pubblici',
            'Mani Solidali – Assistenza Anziani e Fragilità',
            'Orto Sociale Comunitario',
            'Biblioteca Vivente – Storie di Vita',
            'Senza Barriere – Accessibilità e Inclusione',
            'Verde in Città – Urban Gardening',
            'Casa del Quartiere – Rigenerazione Urbana',
            'Radici e Futuro – Archivi Storici Locali',
            'Cucina Solidale – Food Rescue e Redistribuzione',
            'Bosco Urbano – Riforestazione Partecipata',
            'Aule Aperte – Doposcuola nelle Periferie',
            'Il Filo della Comunità – Sartoria Sociale',
            // Youth
            'Euro Youth Dialogue – Voce ai Giovani',
            'Culture Mix Camp – Scambio tra Culture',
            'Democrazia e Partecipazione Giovanile',
            'ArtLink – Arte Giovanile Europea',
            'EcoYouth Camp – Natura e Sostenibilità',
            'Youth Media Lab – Comunicazione Creativa',
            'PeaceBuilding Youth Forum',
            'Mobility & Inclusion – Muoversi senza Confini',
            'Storie di Quartiere – Fotografia Sociale',
            'TeaCH – Insegnare con il Teatro',
            // Training
            'Non-Formal Education Tools – Formatori in Azione',
            'Project Management per ONG e Associazioni',
            'Competenze Digitali per Operatori Sociali',
            'Comunicazione Interculturale e Mediazione',
            'Fundraising e Scrittura Progettuale Erasmus+',
            'Leadership Giovanile e Facilitazione di Gruppo',
            'Valutazione dell\'Impatto Sociale nei Progetti',
            'Mindfulness e Benessere per Operatori del Terzo Settore',
            // Trasversali
            'Inclusion Lab – Disabilità e Sport',
            'Digital Heritage – Patrimonio nell\'Era Digitale',
            'Giovani Ambasciatori per il Clima',
            'Active Citizens Forum – Partecipazione Democratica',
            'Social Innovation Sprint',
            'Volontariato in Rete – Piattaforme Digitali Civiche',
            'Lingue e Frontiere – Italiano per Migranti',
        ];

        // Genera date coerenti distribuite su 2024–2026: expire_date < start_date < end_date
        $startDate = $this->faker->dateTimeBetween('-24 months', '+12 months');
        $duration = $this->faker->numberBetween(7, 365);
        $endDate = (clone $startDate)->modify("+{$duration} days");
        
        // La data di scadenza per le candidature deve essere PRIMA della data di inizio
        $expireDaysBeforeStart = $this->faker->numberBetween(1, 30);
        $expireDate = (clone $startDate)->modify("-{$expireDaysBeforeStart} days");
        
        // Immagini di default disponibili
        $defaultImages = [
            'img/projects/default1.png',
            'img/projects/default2.png',
            'img/projects/default3.png',
            'img/projects/default4.png',
            'img/projects/default5.png',
            'img/projects/default6.png',
            'img/projects/default7.png',
            'img/projects/default8.png',
            'img/projects/default9.png',
            'img/projects/default10.png',
            'img/projects/default11.png',
            'img/projects/default12.png',
            'img/projects/default13.png',
            'img/projects/default14.png',
            'img/projects/default15.png',
            'img/projects/default16.png',
            'img/projects/default17.png',
            'img/projects/default18.png',
            'img/projects/default19.png',
            'img/projects/default20.png',
            'img/projects/default21.png',
            'img/projects/default22.png',
            'img/projects/default23.png',
            'img/projects/default24.png',
            'img/projects/default25.png',
            'img/projects/default26.jpg',
        ];
        
        return [
            'title' => $this->faker->randomElement($projectTitles),
            'user_id' => User::where('role', 'admin')->inRandomOrder()->first()?->id ?? User::factory()->admin()->create()->id,
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory()->create()->id,
            'association_id' => Association::inRandomOrder()->first()?->id ?? Association::factory()->create()->id,
            'image_path' => $this->faker->randomElement($defaultImages),
            'status' => $this->faker->randomElement(['draft', 'published', 'completed']),
            'requested_people' => $this->faker->numberBetween(2, 15),
            'location' => $this->faker->randomElement($europeanCities),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'expire_date' => $expireDate,
            'sum_description' => $this->generateRealisticSummary(),
            'full_description' => $this->generateRealisticDescription(),
            'requirements' => $this->generateRealisticRequirements(),
            'travel_conditions' => $this->generateRealisticTravelConditions(),
        ];
    }
    
    /**
     * Generate realistic short summaries (sum_description) in Italian.
     */
    private function generateRealisticSummary(): string
    {
        $summaries = [
            'Progetto di volontariato europeo per la promozione della sostenibilità ambientale nelle comunità locali attraverso azioni concrete e sensibilizzazione.',
            'Iniziativa di solidarietà dedicata al supporto delle fasce più vulnerabili della popolazione, con attività di assistenza e animazione sociale.',
            'Scambio giovanile internazionale per favorire il dialogo interculturale, la cittadinanza attiva e la partecipazione democratica tra giovani europei.',
            'Progetto ESC per la valorizzazione e preservazione del patrimonio culturale locale attraverso catalogazione, restauro e comunicazione digitale.',
            'Campo di formazione non-formale rivolto a educatori e operatori giovanili su metodologie partecipative e strumenti europei.',
            'Servizio di volontariato a lungo termine a supporto di organizzazioni sociali impegnate nell\'inclusione di persone con disabilità e in condizioni di fragilità.',
            'Progetto di cooperazione internazionale che usa lo sport e le arti come strumenti di integrazione e coesione in comunità multiculturali.',
            'Laboratorio di innovazione sociale per giovani europei che vogliono sviluppare soluzioni concrete a sfide locali usando tecnologia e creatività.',
            'Corso di formazione intensivo su project management, fundraising e scrittura progettuale per il nonprofit e le organizzazioni giovanili.',
            'Programma di volontariato ambientale per la riforestazione, la cura di spazi verdi urbani e l\'educazione ecologica nelle periferie cittadine.',
            'Progetto di inclusione digitale per ridurre il divario tecnologico tra anziani e persone vulnerabili attraverso corsi pratici e supporto diretto.',
            'Esperienza di volontariato in ambito educativo: supporto scolastico, doposcuola e laboratori creativi per bambini e ragazzi nelle periferie.',
            'Progetto giovanile europeo focalizzato sulla comunicazione e i media come strumenti di advocacy per i diritti umani e la giustizia sociale.',
            'Servizio ESC in un\'organizzazione culturale locale: produzione di eventi, gestione di archivi e promozione del patrimonio immateriale.',
            'Training residenziale su comunicazione interculturale, mediazione dei conflitti e facilitazione di gruppi internazionali diversificati.',
            'Progetto di rigenerazione urbana partecipata: i volontari collaborano con residenti e associazioni per riqualificare spazi pubblici abbandonati.',
            'Iniziativa giovanile per la sensibilizzazione sui cambiamenti climatici: attività di street art, eventi pubblici e campagne social nei quartieri.',
            'Progetto di volontariato in una biblioteca pubblica: catalogazione, animazione della lettura e organizzazione di eventi culturali aperti alla cittadinanza.',
        ];

        return $this->faker->randomElement($summaries);
    }

    /**
     * Generate realistic project descriptions.
     */
    private function generateRealisticDescription(): string
    {
        $descriptions = [
            "Questo progetto mira a promuovere la sostenibilità ambientale attraverso azioni concrete nella comunità locale. I partecipanti avranno l'opportunità di lavorare su iniziative di educazione ambientale, pulizia di spazi pubblici e sensibilizzazione sui cambiamenti climatici.",
            "Un'iniziativa dedicata al supporto delle fasce più vulnerabili della popolazione. Il progetto prevede attività di assistenza sociale, organizzazione di eventi comunitari e sviluppo di reti di solidarietà tra i cittadini.",
            "Progetto di cooperazione internazionale che coinvolge giovani da tutta Europa. L'obiettivo è creare ponti culturali attraverso scambi, workshop creativi e attività di promozione del dialogo interculturale.",
            "Iniziativa focalizzata sulla preservazione e valorizzazione del patrimonio culturale locale. I volontari parteciperanno a attività di catalogazione, restauro e promozione di siti storici e tradizioni culturali.",
            "Progetto innovativo che utilizza la tecnologia per risolvere problematiche sociali. Include lo sviluppo di app per il volontariato, piattaforme digitali per l'inclusione e strumenti tech per migliorare la qualità della vita."
        ];
        
        return $this->faker->randomElement($descriptions);
    }
    
    /**
     * Generate realistic requirements.
     */
    private function generateRealisticRequirements(): string
    {
        $requirements = [
            "Età: 18-30 anni. Conoscenza base dell'inglese. Motivazione e entusiasmo per il volontariato. Capacità di lavorare in team multiculturali.",
            "Maggiore età. Esperienza precedente nel volontariato (preferibile). Buone capacità comunicative. Flessibilità e adattabilità.",
            "Età: 18-25 anni. Laurea o diploma in corso. Conoscenza di almeno una lingua straniera. Interesse per l'innovazione sociale.",
            "Nessun requisito specifico di esperienza. Passione per la cultura e il patrimonio. Disponibilità per l'intero periodo del progetto.",
            "Competenze informatiche di base. Creatività e problem-solving. Capacità di lavorare in autonomia e in gruppo."
        ];
        
        return $this->faker->randomElement($requirements);
    }
    
    /**
     * Generate realistic travel conditions.
     */
    private function generateRealisticTravelConditions(): string
    {
        $conditions = [
            "Viaggio coperto fino a 275€. Alloggio in condivisione fornito. Vitto e pocket money mensile di 150€. Assicurazione sanitaria inclusa.",
            "Rimborso viaggio al 100% fino a 180€. Sistemazione in famiglia ospitante. Tre pasti al giorno inclusi. Trasporti locali coperti.",
            "Viaggio a carico del partecipante. Alloggio in struttura condivisa. Indennità giornaliera di 8€. Certificato di partecipazione Youthpass.",
            "Rimborso viaggio parziale (70%). Vitto e alloggio completamente coperti. Attività ricreative e culturali incluse nel programma.",
            "Tutti i costi coperti dall'organizzazione. Alloggio in camera singola o doppia. Supporto linguistico e culturale durante tutto il periodo."
        ];
        
        return $this->faker->randomElement($conditions);
    }
    
    /**
     * Create a published project.
     */
    public function published(): static
    {
        $startDate = $this->faker->dateTimeBetween('+2 weeks', '+8 months');
        $duration = $this->faker->numberBetween(14, 180);
        $endDate = (clone $startDate)->modify("+{$duration} days");
        $expireDaysBeforeStart = $this->faker->numberBetween(7, 21);
        $expireDate = (clone $startDate)->modify("-{$expireDaysBeforeStart} days");

        return $this->state(fn (array $attributes) => [
            'status'      => 'published',
            'start_date'  => $startDate,
            'end_date'    => $endDate,
            'expire_date' => $expireDate,
        ]);
    }
    
    /**
     * Create a completed project.
     */
    public function completed(): static
    {
        $startDate = $this->faker->dateTimeBetween('-12 months', '-1 month');
        $duration = $this->faker->numberBetween(7, 90);
        $endDate = (clone $startDate)->modify("+{$duration} days");
        
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'expire_date' => (clone $startDate)->modify('-' . $this->faker->numberBetween(7, 30) . ' days'),
        ]);
    }
}
