<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Benny Moza'
        ]);
        Supplier::create([
            'name' => 'Eden Hazard'
        ]);
        Supplier::create([
            'name' => 'CV meat berkah'
        ]);
        Supplier::create([
            'name' => 'PT bumi perkasa'
        ]);
    }
}
