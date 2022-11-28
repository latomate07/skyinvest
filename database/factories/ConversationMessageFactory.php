<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConversationMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uid' => Str::random(20),
            'message' => fake()->text(40),
            'is_seen' => fake()->boolean(),
            'conversation_id' => Conversation::all()->random()->id,
            'from_id' => User::all()->random()->id,
            'to_id' => User::all()->random()->id
        ];
    }
}
