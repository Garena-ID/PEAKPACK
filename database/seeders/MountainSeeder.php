<?php

namespace Database\Seeders;

use App\Models\Mountain;
use Illuminate\Database\Seeder;

class MountainSeeder extends Seeder
{
    public function run(): void
    {
       Mountain::updateOrCreate(
    ['name' => 'Gunung Gede'],
    [
        'location' => 'Cibodas',
        'province' => 'Jawa Barat',
        'elevation' => 2958,
        'difficulty' => 'Medium',
        'estimated_duration' => '1-2 hari',
        'description' => 'Gunung Gede merupakan salah satu gunung populer di Jawa Barat.',
        'latitude' => -6.7875,
        'longitude' => 106.9790,
    ]
);

Mountain::updateOrCreate(
    ['name' => 'Gunung Papandayan'],
    [
        'location' => 'Garut',
        'province' => 'Jawa Barat',
        'elevation' => 2665,
        'difficulty' => 'Easy',
        'estimated_duration' => '1 hari',
        'description' => 'Gunung Papandayan memiliki jalur pendakian yang relatif mudah.',
        'latitude' => -7.3190,
        'longitude' => 107.7310,
    ]
);

Mountain::updateOrCreate(
    ['name' => 'Gunung Ciremai'],
    [
        'location' => 'Kuningan',
        'province' => 'Jawa Barat',
        'elevation' => 3078,
        'difficulty' => 'Hard',
        'estimated_duration' => '1-2 hari',
        'description' => 'Gunung Ciremai merupakan gunung tertinggi di Jawa Barat.',
        'latitude' => -6.8920,
        'longitude' => 108.4050,
    ]
);
    }
}