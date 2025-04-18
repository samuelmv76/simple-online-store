<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Peripheral;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear categorías fijas
        $categories = ['Mouse', 'Teclado', 'Auriculares', 'Monitor', 'Silla Gaming'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        // Crear 50 periféricos aleatorios relacionados con categorías
        Peripheral::factory(50)->create();
    }
}
