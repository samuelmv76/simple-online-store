<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Peripheral;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar categorías
        $categories = ['Mouse', 'Teclado', 'Auriculares', 'Monitor', 'Silla Gaming'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        // Cargar periféricos desde JSON
        $json = File::get(database_path('data/peripherals.json'));
        $peripherals = json_decode($json, true);

        foreach ($peripherals as $item) {
            $category = Category::where('name', $item['category'])->first();

            Peripheral::create([
                'name' => $item['name'],
                'brand' => $item['brand'],
                'category_id' => $category->id,
                'price' => $item['price'],
                'stock' => $item['stock'],
                'description' => $item['description'],
                'image_url' => $item['image_url'],
            ]);
        }

        // Cargar usuarios desde JSON
        $json = File::get(database_path('data/users.json'));
        $users = json_decode($json, true);

        foreach ($users as $userData) {
            User::firstOrCreate([
                'email' => $userData['email']
            ], [
                'name' => $userData['name'],
                'password' => Hash::make($userData['password']),
                'rol' => $userData['rol'],
            ]);
        }
    }
}
