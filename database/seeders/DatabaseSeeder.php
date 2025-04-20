<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Peripheral;
use App\Models\User;
use App\Models\ProductImagen;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear categorías normalizadas
        $categories = ['Mouse', 'Teclado', 'Auriculares', 'Monitor', 'Silla Gaming'];
        foreach ($categories as $cat) {
            Category::firstOrCreate([
                'name' => ucfirst(strtolower(trim($cat)))
            ]);
        }

        // Cargar periféricos desde JSON
        $json = File::get(database_path('data/peripherals.json'));
        $peripherals = json_decode($json, true);

        foreach ($peripherals as $item) {
            $categoryName = ucfirst(strtolower(trim($item['category'])));
            $category = Category::where('name', $categoryName)->first();

            Peripheral::create([
                'name' => $item['name'],
                'brand' => $item['brand'],
                'category_id' => $category->id ?? null,
                'price' => $item['price'],
                'stock' => $item['stock'],
                'description' => $item['description'],
            ]);
        }

        // Cargar imágenes desde JSON local
        $jsonImages = File::get(database_path('data/peripherals_images.json'));
        $images = json_decode($jsonImages, true);

        foreach ($images as $img) {
            ProductImagen::create([
                'peripheral_id' => $img['peripheral_id'],
                'url_imagen' => $img['url_imagen']
            ]);
        }

        // Insertar usuarios desde JSON
        $json = File::get(database_path('data/users.json'));
        $users = json_decode($json, true);

        foreach ($users as $userData) {
            User::firstOrCreate([
                'email' => $userData['email']
            ], [
                'name' => $userData['name'],
                'surname' => $userData['surname'] ?? '',
                'password' => Hash::make($userData['password']),
                'rol' => $userData['rol'],
            ]);
        }
    }
}
