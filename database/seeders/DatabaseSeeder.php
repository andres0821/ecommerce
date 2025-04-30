<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Borrar la carpeta de imagenes de productos
        Storage::deleteDirectory('products');
        // Crear la carpeta de imagenes de productos
        Storage::makeDirectory('products');

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            FamilySeeder::class,
            OptionSeeder::class,
        ]);
        
        Product::factory(150)->create();
    }
}
