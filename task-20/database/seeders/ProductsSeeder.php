<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{

    public array $types = [
        'Laptop', 'Mobile', 'Fridge', 'TV'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $type) {
            for ($i = 0; $i < 5; $i++) {
                Product::factory()->create([
                    'type' => $type,
                    'name' => $type . '-' . random_int(121, 12345)
                ]);
            }
        }
    }
}
