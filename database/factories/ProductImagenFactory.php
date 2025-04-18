<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImagenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url_imagen' => $this->faker->imageUrl(640, 480, 'technics', true),
        ];
    }
}
