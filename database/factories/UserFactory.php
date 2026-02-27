<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    private const NOMI_MASCHILI = [
        'Marco', 'Luca', 'Andrea', 'Matteo', 'Davide', 'Simone', 'Alessandro',
        'Francesco', 'Lorenzo', 'Riccardo', 'Filippo', 'Nicola', 'Giorgio',
        'Roberto', 'Stefano', 'Antonio', 'Giuseppe', 'Paolo', 'Leonardo', 'Sergio',
        'Emanuele', 'Gianluca', 'Tommaso', 'Daniele', 'Alberto',
    ];

    private const NOMI_FEMMINILI = [
        'Sofia', 'Giulia', 'Chiara', 'Sara', 'Valentina', 'Martina', 'Federica',
        'Elisa', 'Laura', 'Francesca', 'Alessia', 'Paola', 'Claudia', 'Monica',
        'Silvia', 'Elena', 'Beatrice', 'Anna', 'Maria', 'Roberta',
        'Irene', 'Alice', 'Serena', 'Noemi', 'Camilla',
    ];

    private const COGNOMI = [
        'Rossi', 'Bianchi', 'Ferrari', 'Esposito', 'Romano', 'Colombo', 'Ricci',
        'Marino', 'Greco', 'Bruno', 'Gallo', 'Conti', 'De Luca', 'Mancini',
        'Costa', 'Giordano', 'Rizzo', 'Lombardi', 'Moretti', 'Barbieri',
        'Fontana', 'Santoro', 'Mariani', 'Rinaldi', 'Caruso', 'Ferretti',
        'Pinto', 'Orlando', 'Longo', 'Fabbri', 'Villa', 'Coppola', 'Serra',
        'Ferrara', 'Testa', 'Palumbo', 'Caputo', 'Sanna', 'Messina', 'Gatti',
    ];

    private const PREFISSI = [
        '320', '328', '329', '333', '338', '347', '348', '349',
        '366', '370', '380', '388', '389', '391', '392', '393',
    ];

    private function nomeItaliano(): string
    {
        $femminile = $this->faker->boolean();
        $nome = $femminile
            ? $this->faker->randomElement(self::NOMI_FEMMINILI)
            : $this->faker->randomElement(self::NOMI_MASCHILI);
        $cognome = $this->faker->randomElement(self::COGNOMI);
        return "$nome $cognome";
    }

    private function emailItaliana(string $nome): string
    {
        $parti = explode(' ', mb_strtolower($nome));
        $first = iconv('UTF-8', 'ASCII//TRANSLIT', $parti[0]);
        $last  = iconv('UTF-8', 'ASCII//TRANSLIT', end($parti));
        $domains = ['gmail.com', 'libero.it', 'hotmail.it', 'yahoo.it', 'outlook.it', 'tiscali.it', 'virgilio.it'];
        $sep     = $this->faker->randomElement(['.', '_', '']);
        $numero  = $this->faker->boolean(25) ? $this->faker->numberBetween(1, 99) : '';
        return "{$first}{$sep}{$last}{$numero}@" . $this->faker->randomElement($domains);
    }

    private function telefonoItaliano(): string
    {
        $prefix = $this->faker->randomElement(self::PREFISSI);
        return '+39 ' . $prefix . ' ' . $this->faker->numerify('### ####');
    }

    public function definition(): array
    {
        $nome = $this->nomeItaliano();
        return [
            'name'              => $nome,
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
            'role'              => 'registered_user',
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        $nome = $this->nomeItaliano();
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'name' => $nome,
        ]);
    }

    public function italian(): static
    {
        $nome = $this->nomeItaliano();
        return $this->state(fn (array $attributes) => [
            'name' => $nome,
        ]);
    }
}
