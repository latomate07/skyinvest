<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
            'pseudo' => fake()->unique()->lastName(),
            'role' => fake()->randomElement(['Investisseur', 'Entreprise']),
            'country' => fake()->text(30),
            'isAgreedWithTerms' => fake()->randomElement(['on', 'off']),
            'wishNewsletter' => fake()->randomElement(['on', 'off']),
            'neph_number' => Str::random(16),
            'juridique_status' => fake()->randomElement(['EURL', 'SARL', 'SASU', 'SAS', 'SA']),
            'bilan_enterprise' => fake()->numberBetween(500, 15000),
            'adresse' => Str::random(15),
            'phone_number' => fake()->phoneNumber(),
            'iban' => Str::random(26),
            'identity_card' => fake()->url(),
            'source_of_income' => fake()->randomElement(['Salaire', 'Bénéfices']),
            'user_profession' => fake()->randomElement(['Salarié', 'Entrepreneur']),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
