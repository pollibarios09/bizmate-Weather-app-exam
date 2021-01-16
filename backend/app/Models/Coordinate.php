<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coordinate extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat',
        'long',
        'city_id',
    ];


    public function city()
    {
        return $this->hasOne(City::class);
    }
}
