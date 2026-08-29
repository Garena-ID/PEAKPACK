<?php

namespace Database\Seeders;

use App\Models\GearCategory;
use Illuminate\Database\Seeder;

class GearCategorySeeder extends Seeder
{
    public function run(): void
    {
        GearCategory::updateOrCreate(
    ['name' => 'Tenda']
);

GearCategory::updateOrCreate(
    ['name' => 'Carrier']
);

GearCategory::updateOrCreate(
    ['name' => 'Sleeping Bag']
);

GearCategory::updateOrCreate(
    ['name' => 'Penerangan']
);
    }
}