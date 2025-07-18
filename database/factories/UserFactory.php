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
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'registered_user',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    
    /**
     * Create an admin user.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'name' => fake()->name() . ' (Admin)',
        ]);
    }
    
    /**
     * Create a user with Italian-sounding names.
     */
    public function italian(): static
    {
        $italianNames = [
            'Marco Rossi', 'Giulia Bianchi', 'Francesco Ferrari', 'Chiara Romano',
            'Alessandro Galli', 'Francesca Conti', 'Matteo Ricci', 'Elena Marino',
            'Davide Costa', 'Silvia Giordano', 'Simone Mancini', 'Valentina Rizzo',
            'Andrea Lombardi', 'Martina Moretti', 'Luca Bruno', 'Sara Greco'
        ];
        
        return $this->state(fn (array $attributes) => [
            'name' => fake()->randomElement($italianNames),
        ]);
    }
}
