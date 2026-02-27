<?php

namespace Database\Seeders;

use App\Models\Association;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder
{
    public function run(): void
    {
        $associations = [
            [
                'name'        => 'ARCI – Circolo Culturale Europeo',
                'description' => 'Rete associativa che promuove la cultura, il volontariato e la partecipazione civica in tutta Europa.',
            ],
            [
                'name'        => 'Europa Giovani APS',
                'description' => 'Associazione di promozione sociale dedicata alla mobilità giovanile, all\'Erasmus+ e ai programmi UE per i giovani.',
            ],
            [
                'name'        => 'Legambiente Volontariato',
                'description' => 'Braccio volontaristico di Legambiente, impegnato in campi di lavoro ambientale in Italia e all\'estero.',
            ],
            [
                'name'        => 'CESC Project – Formazione Solidale',
                'description' => 'Organizzazione specializzata in Corpo Europeo di Solidarietà, scambi giovanili e formazione non-formale.',
            ],
            [
                'name'        => 'Servizio Civile Internazionale Italia',
                'description' => 'Associazione di volontariato internazionale che realizza campi di lavoro e scambi culturali in tutta Europa dal 1946.',
            ],
            [
                'name'        => 'Lunaria – Cooperazione e Solidarietà',
                'description' => 'Associazione attiva nella promozione della pace, della solidarietà internazionale e della mobilità giovanile.',
            ],
            [
                'name'        => 'CSV Lazio – Centro Servizi Volontariato',
                'description' => 'Ente che supporta le organizzazioni di volontariato con formazione, risorse professionali e accompagnamento progettuale.',
            ],
            [
                'name'        => 'AEGEE Italia – Studenti Europei',
                'description' => 'Rete di studenti universitari europei che organizza eventi, scambi e conferenze per la cittadinanza attiva.',
            ],
            [
                'name'        => 'Giovani Senza Frontiere ODV',
                'description' => 'ODV che facilita la mobilità transnazionale dei giovani tramite programmi comunitari e bilaterali.',
            ],
            [
                'name'        => 'Progetto Tenda ONLUS',
                'description' => 'Organizzazione non profit impegnata nella cooperazione internazionale, nel dialogo interreligioso e nella costruzione della pace.',
            ],
            [
                'name'        => 'FAIR – Formazione Ambiente Integrazione',
                'description' => 'Associazione che promuove l\'educazione ambientale, l\'integrazione culturale e la responsabilità sociale nei programmi giovanili.',
            ],
            [
                'name'        => 'Forum Giovani Europei',
                'description' => 'Piattaforma di coordinamento tra associazioni giovanili europee per l\'advocacy, la partecipazione democratica e i diritti giovanili.',
            ],
        ];

        foreach ($associations as $data) {
            Association::create($data);
        }

        $this->command->info('Create ' . Association::count() . ' associazioni.');
    }
}
