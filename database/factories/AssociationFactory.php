<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Association>
 */
class AssociationFactory extends Factory
{
    private const ASSOCIAZIONI = [
        ['ARCI – Circolo Culturale Europeo',         'Rete associativa che promuove la cultura, il volontariato e la partecipazione civica in tutta Europa.'],
        ['CSV Lazio – Centro Servizi Volontariato',   'Ente di supporto alle organizzazioni di volontariato con formazione, risorse e accompagnamento progettuale.'],
        ['Lunaria – Cooperazione e Solidarietà',      'Associazione attiva nella promozione della pace, della solidarietà internazionale e della mobilità giovanile.'],
        ['CESC Project – Formazione Solidale',        'Organizzazione specializzata in Corpo Europeo di Solidarietà, scambi giovanili e formazione non-formale.'],
        ['Servizio Civile Internazionale Italia',     'Associazione di volontariato internazionale che realizza campi di lavoro e scambi culturali in tutta Europa.'],
        ['Progetto Tenda ONLUS',                      'Organizzazione non profit impegnata nella cooperazione internazionale, nel dialogo interreligioso e nella pace.'],
        ['AEGEE Italia – Studenti Europei',           'Rete di studenti universitari europei che organizza eventi, scambi e conferenze per la cittadinanza attiva.'],
        ['Europa Giovani APS',                        'Associazione di promozione sociale dedicata alla mobilità giovanile, all\'Erasmus+ e ai programmi UE.'],
        ['Giovani Senza Frontiere ODV',               'ODV che facilita la mobilità transnazionale dei giovani tramite programmi comunitari e bilaterali.'],
        ['Legambiente Volontariato',                  'Braccio volontaristico di Legambiente, impegnato in campi di lavoro ambientale in Italia e all\'estero.'],
        ['FAIR – Formazione Ambiente Integrazione',   'Associazione che promuove l\'educazione ambientale, l\'integrazione culturale e la responsabilità sociale.'],
        ['Forum Giovani Europei',                     'Piattaforma di coordinamento tra associazioni giovanili europee che si occupa di advocacy e partecipazione.'],
    ];

    public function definition(): array
    {
        $entry = $this->faker->randomElement(self::ASSOCIAZIONI);
        return [
            'name'        => $entry[0],
            'description' => $entry[1],
        ];
    }
}
