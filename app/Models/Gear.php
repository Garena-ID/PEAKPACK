<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gear extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'stock',
        'rental_price',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(GearCategory::class, 'category_id');
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function recommendations()
    {
        return $this->hasMany(MountainRecommendation::class);
    }
}