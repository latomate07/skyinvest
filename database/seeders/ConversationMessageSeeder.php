<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConversationMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConversationMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConversationMessage::factory()
                            ->count(200)
                            ->create();
    }
}
