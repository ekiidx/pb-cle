<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'community_id' => 1,
            'title' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'url' => fake()->url(),
            'description' => fake()->realText(),
            'post_image' => fake()->imageUrl(),
            'post_image_slug' => fake()->imageUrl(),
            'votes' => fake()->randomNumber(2, false),
        ];
    }
}
