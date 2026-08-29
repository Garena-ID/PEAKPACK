<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GearCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function gears()
    {
        return $this->hasMany(Gear::class, 'category_id');
    }
}