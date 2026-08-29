<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rental_code',
        'rental_date',
        'due_date',
        'return_date',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'rental_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
            'total_price' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }
}