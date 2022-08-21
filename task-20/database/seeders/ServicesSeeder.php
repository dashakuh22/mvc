<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{

    public array $types = [
        'Install', 'Warranty', 'Configure', 'Delivery'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $type) {
            Service::factory()->create([
                'type' => $type,
            ]);
        }
    }
}
