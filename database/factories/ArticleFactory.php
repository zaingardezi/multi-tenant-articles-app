<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    // 👇 THIS LINE GOES HERE (inside the class)
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'Title' => fake()->sentence(),
            'Text' => fake()->paragraph(),
            'ShowDescription' => fake()->sentence(),
            'Image' => 'https://picsum.photos/600/400',
        ];
    }
}