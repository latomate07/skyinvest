<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Get default user_id for testing
     * 
     * @var int
     */
    protected $currentFakeUser = 4;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uid' => Str::random(20),
            'status' => fake()->randomElement(['active', 'blocked', 'archived']),
            'from_id' => fake()->randomElement([6, 9, 11, 13, 15]),
            'to_id' => User::all()->random()->id
        ];
    }
}
