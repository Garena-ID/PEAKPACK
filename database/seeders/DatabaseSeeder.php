<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            MountainSeeder::class,
            GearCategorySeeder::class,
            GearSeeder::class,
            MountainRecommendationSeeder::class,
        ]);
    }
}