<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => fake()->unique()->sentence(),
            'slug' => fake()->unique()->slug(),
            'event_date' => fake()->date('Y_m_d'),
            'event_genres' => fake()->randomElement(['techno', 'house', 'uk hardcore']),
            'event_time' => fake()->time(),
            'content' => fake()->realtext(),
        ];
    }
}
