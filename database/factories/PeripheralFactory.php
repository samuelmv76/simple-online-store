<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeripheralFactory extends Factory
{
    protected $model = \App\Models\Peripheral::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Logitech G502 Hero',
                'Corsair K95 RGB',
                'HyperX Cloud II',
                'Asus ROG Swift PG27UQ',
                'Secretlab Titan Evo'
            ]),
            'brand' => $this->faker->randomElement([
                'Logitech', 'Corsair', 'HyperX', 'Asus', 'Secretlab'
            ]),
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'price' => $this->faker->randomFloat(2, 40, 300),
            'stock' => $this->faker->numberBetween(5, 100),
            'description' => $this->faker->sentence(12),
            'image_url' => $this->faker->imageUrl(640, 480, 'technics', true),
        ];
    }
}
