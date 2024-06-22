<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      return [
        // Generate random text for the comment body and a random name for the author
        'post_id' => \App\Models\Post::factory(),
        'body' => $this->faker->text(200), 
        'author' => $this->faker->name,
      ];
    }
}
