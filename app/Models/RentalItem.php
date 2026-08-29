<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'gear_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function gear()
    {
        return $this->belongsTo(Gear::class);
    }
}