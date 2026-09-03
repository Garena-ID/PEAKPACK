<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mountain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'province',
        'elevation',
        'difficulty',
        'estimated_duration',
        'description',
        'image',
        'latitude',
        'longitude',
    ];

    public function recommendations()
    {
        return $this->hasMany(MountainRecommendation::class);
    }
}