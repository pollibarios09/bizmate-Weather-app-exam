<?php

namespace App\Models;

use App\Models\Coordinate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
