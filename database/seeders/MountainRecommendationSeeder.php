<?php

namespace Database\Seeders;


use App\Models\Gear;
// use App\Models\GearCategory;
use Illuminate\Database\Seeder;
use App\Models\Mountain;
use App\Models\MountainRecommendation;


class MountainRecommendationSeeder extends Seeder
{
    public function run(): void
    {
       $gede = Mountain::where('name', 'Gunung Gede')->first();
$papandayan = Mountain::where('name', 'Gunung Papandayan')->first();
$ciremai = Mountain::where('name', 'Gunung Ciremai')->first();

$tenda = Gear::where('name', 'Tenda 2 Orang')->first();
$carrier = Gear::where('name', 'Carrier 40L')->first();
$sleepingBag = Gear::where('name', 'Sleeping Bag')->first();
$headlamp = Gear::where('name', 'Headlamp')->first();

MountainRecommendation::updateOrCreate([
    'mountain_id' => $gede->id,
    'gear_id' => $tenda->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $gede->id,
    'gear_id' => $carrier->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $gede->id,
    'gear_id' => $sleepingBag->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $papandayan->id,
    'gear_id' => $carrier->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $papandayan->id,
    'gear_id' => $sleepingBag->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $ciremai->id,
    'gear_id' => $tenda->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $ciremai->id,
    'gear_id' => $carrier->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $ciremai->id,
    'gear_id' => $sleepingBag->id,
]);

MountainRecommendation::updateOrCreate([
    'mountain_id' => $ciremai->id,
    'gear_id' => $headlamp->id,
]);
    }
}