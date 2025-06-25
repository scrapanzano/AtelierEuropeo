<?php

namespace Database\Seeders;

use App\Models\Association;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $associations = [
            [
                'name' => 'Associazione Volontari Italiani',
                'description' => 'Organizzazione che si occupa di volontariato in tutta Italia',
            ],
            [
                'name' => 'Europa Giovani',
                'description' => 'Associazione per scambi culturali tra giovani europei',
            ],
            [
                'name' => 'EcoFuturo',
                'description' => 'Associazione per la sostenibilità ambientale',
            ],
            [
                'name' => 'Cultura Senza Frontiere',
                'description' => 'Promozione della diversità culturale e artistica',
            ],
            [
                'name' => 'TechVolunteers',
                'description' => 'Volontariato nel campo dell\'innovazione tecnologica',
            ],
        ];

        foreach ($associations as $associationData) {
            Association::create($associationData);
        }
    }
}
