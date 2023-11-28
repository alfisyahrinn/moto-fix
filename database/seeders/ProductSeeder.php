<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'user_id' => 1,
            'name' => 'Federal Oli',
            'description' => 'Federal',
            'price' => 35000,
            'stock' => 10,
            'image' => 'Federal',
            'supplier_id' => 1,
            'category_id' => 1,
        ]);
        Product::create([
            'user_id' => 2,
            'name' => 'Piston 35mm',
            'description' => 'bor up',
            'price' => 123000,
            'stock' => 10,
            'image' => 'Federal',
            'supplier_id' => 1,
            'category_id' => 2,
        ]);
        Product::create([
            'user_id' => 2,
            'name' => 'Piston 50mm',
            'description' => 'bor up',
            'price' => 240000,
            'stock' => 10,
            'image' => 'Federal',
            'supplier_id' => 1,
            'category_id' => 2,
        ]);
        Product::create([
            'user_id' => 2,
            'name' => 'Velg TK racing',
            'description' => 'bor up',
            'price' => 300000,
            'stock' => 10,
            'image' => 'Federal',
            'supplier_id' => 1,
            'category_id' => 2,
        ]);
        Product::create([
            'user_id' => 2,
            'name' => 'Jari Jari',
            'description' => 'bor up',
            'price' => 10000,
            'stock' => 10,
            'image' => 'Federal',
            'supplier_id' => 1,
            'category_id' => 2,
        ]);
    }
}
