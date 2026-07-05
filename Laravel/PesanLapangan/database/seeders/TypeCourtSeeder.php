<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('type_court')->insert([
            [
                'name' => 'Futsal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Badminton',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
