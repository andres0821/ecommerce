<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => [
                    ['value' => 'S', 'description' => 'Small'],
                    ['value' => 'M', 'description' => 'Medium'],
                    ['value' => 'L', 'description' => 'Large'],
                    ['value' => 'XL', 'description' => 'Extra Large'],
                ]
            ],
            [
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    ['value' => '#000000', 'description' => 'Black'],
                    ['value' => '#FFFFFF', 'description' => 'White'],
                    ['value' => '#FF0000', 'description' => 'Red'],
                    ['value' => '#FFFF00', 'description' => 'Yellow'],
                    ['value' => '#FFA500', 'description' => 'Orange'],
                    ['value' => '#800080', 'description' => 'Purple'],
                    ['value' => '#FFC0CB', 'description' => 'Pink'],
                    ['value' => '#808080', 'description' => 'Gray'],
                    ['value' => '#A52A2A', 'description' => 'Brown'],
                    ['value' => '#0000FF', 'description' => 'Blue'],
                    ['value' => '#008000', 'description' => 'Green'],
                    ['value' => '#FFFFF0', 'description' => 'Ivory'],
                    ['value' => '#FFD700', 'description' => 'Gold'],
                    ['value' => '#C0C0C0', 'description' => 'Silver'],
                ]
            ],
            [
                'name' => 'Sexo',
                'type' => 1,
                'features' => [
                    ['value' => 'M', 'description' => 'Masculino'],
                    ['value' => 'F', 'description' => 'Femenino'],
                    ['value' => 'U', 'description' => 'Unisex'],
            
                ]        
            ],
            
        ];

        foreach ($options as $option) {
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);

            foreach ($option['features'] as $feature) {
                $optionModel->feature()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description'],
                ]);
            }
        }
    }    
}
