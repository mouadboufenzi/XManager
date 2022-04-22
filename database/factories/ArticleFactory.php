<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->numerify('AT###'),
            'designation' => $this->faker->word(),
            'status' => $this->faker->randomElement(['Actif', 'Inactif']),
            'categorie' => $this->faker->randomElement(['Categorie 1', 'Categorie 2', 'Categorie 3']), // password
            'pv' => $this->faker->randomDigit(1000),
            'pa' => $this->faker->randomDigit(1000),
            'uv' => $this->faker->randomDigit(1000),
            'ua' => $this->faker->randomDigit(1000),
        ];
    }
}
