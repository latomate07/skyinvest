<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(400),
            'amount' => fake()->numberBetween(1, 2000),
            'location' => fake()->city(),
            'campaignTime' => fake()->numberBetween(1, 10),
            'minInvest' => fake()->numberBetween(1, 9),
            'profits_percentage' => fake()->numberBetween(1, 20),
            'ytbVideo' => NULL,
            'docs' => NULL,
            'totalViews' => fake()->randomNumber(),
            'type_return_on_investissment' => fake()->randomElement(['Annuel', 'Trimestriel', 'Mensuel']),
            'user_id' => User::all()->random()->id
        ];
    }
}
