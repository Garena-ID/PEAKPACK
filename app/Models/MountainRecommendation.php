<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MountainRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id',
        'gear_id',
    ];

    public function mountain()
    {
        return $this->belongsTo(Mountain::class);
    }

    public function gear()
    {
        return $this->belongsTo(Gear::class);
    }
}