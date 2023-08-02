<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RegistrantQuestion;
use Illuminate\Database\Seeder;

class RegistrantQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistrantQuestion::factory()->count(10)->create();
    }
}
