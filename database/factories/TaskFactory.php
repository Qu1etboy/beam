<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(1, 3), // Generate random status between 1 and 3
            'priority' => $this->faker->numberBetween(1, 3), // Generate random priority between 1 and 3
            'due_date' => $this->faker->date(),
        ];
    }
}
