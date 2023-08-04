<?php

namespace Database\Factories;

use App\Models\Organizer;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organizer_id' => Organizer::factory(),
            'event_name' => $this->faker->catchPhrase,
            'event_description' => $this->faker->paragraph,
            'poster_image' => $this->faker->imageUrl(),
            'location' => $this->faker->city,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'end_date' => $this->faker->dateTimeBetween('now', '+2 year'),
            'is_published' => true,
        ];
    }
}