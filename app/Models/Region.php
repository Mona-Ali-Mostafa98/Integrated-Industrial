<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withDefault();
    }

    // Hide this properties to not return it in the API request
    protected $hidden = [
        'created_at' , 'updated_at',
    ];

}