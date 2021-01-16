<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'weather_id',
        'name',
        'country',
    ];


    public function coordinate()
    {
        return $this->hasOne(Coordinate::class);
    }
}
