<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductImagesSeeder extends Seeder
{
    public function run()
    {
        $jsonPath = database_path('data/peripherals_images.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("Archivo peripherals_images.json no encontrado.");
            return;
        }

        $images = json_decode(File::get($jsonPath), true);

        foreach ($images as $image) {
            DB::table('product_images')->insert([
                'peripheral_id' => $image['peripheral_id'],
                'url_imagen' => $image['url_imagen'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Imágenes insertadas en product_images correctamente.');
    }
}
