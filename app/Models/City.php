<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')->withDefault();
    }

    public function regions()
    {
        return $this->hasMany(Region::class, 'region_id', 'id');
    }

    // Hide this properties to not return it in the API request
    protected $hidden = [
        'created_at' , 'updated_at',
    ];


}
