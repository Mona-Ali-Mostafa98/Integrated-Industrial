<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Accessors use to return full url of logo to use it in api
    // $setting->logo_url
    public function getLogoUrlAttribute()
    {
        if (Str::startsWith($this->logo, ['http://', 'https://'])) {
            return $this->logo;
        }
        return asset('storage/' . $this->logo);
    }

    // return complete logo_url of logo in api request to use it in mobile app
    protected $appends = [
        'logo_url',
    ];

    // Hide this properties to not return it in the API request
    protected $hidden =[
        'logo','created_at' , 'updated_at',
    ];
}
