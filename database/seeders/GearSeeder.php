<?php

namespace Database\Seeders;

use App\Models\Gear;
use App\Models\GearCategory;
use Illuminate\Database\Seeder;

class GearSeeder extends Seeder
{
    public function run(): void
    {
      $tenda = GearCategory::where('name', 'Tenda')->first();
$carrier = GearCategory::where('name', 'Carrier')->first();
$sleepingBag = GearCategory::where('name', 'Sleeping Bag')->first();
$penerangan = GearCategory::where('name', 'Penerangan')->first();

Gear::updateOrCreate(
    ['name' => 'Tenda 2 Orang'],
    [
        'category_id' => $tenda->id,
        'stock' => 5,
        'rental_price' => 50000,
        'description' => 'Tenda untuk kapasitas 2 orang.',
    ]
);

Gear::updateOrCreate(
    ['name' => 'Carrier 40L'],
    [
        'category_id' => $carrier->id,
        'stock' => 5,
        'rental_price' => 35000,
        'description' => 'Carrier dengan kapasitas 40 liter.',
    ]
);

Gear::updateOrCreate(
    ['name' => 'Sleeping Bag'],
    [
        'category_id' => $sleepingBag->id,
        'stock' => 8,
        'rental_price' => 20000,
        'description' => 'Sleeping bag untuk kebutuhan bermalam.',
    ]
);

Gear::updateOrCreate(
    ['name' => 'Headlamp'],
    [
        'category_id' => $penerangan->id,
        'stock' => 10,
        'rental_price' => 15000,
        'description' => 'Lampu kepala untuk membantu penerangan.',
    ]
);
    }
}