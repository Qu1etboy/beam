<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\RegistrantQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistrantQuestion>
 */
class RegistrantQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegistrantQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'question' => $this->faker->sentence,
            // 'answer' => $this->faker->sentence,
        ];
    }
}