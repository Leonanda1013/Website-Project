<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
        'name' => 'Kaso Polos',
        'description' => 'Kaos katun combed 30s',
        'price' => 75000,
        'stock' => 20,
        ]);

        \App\Models\Product::create([
            'name' => 'Celana Jeans',
            'description' => 'Jeans slim fit',
            'price' => 150000,
            'stock' => 15,
        ]);
    }
}
