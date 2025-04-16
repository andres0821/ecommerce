<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Camilo Gil',
            'email' => 'cgil@ecommerce.com',
            'password' => bcrypt('passw0rd')
        ]);
    }
}
