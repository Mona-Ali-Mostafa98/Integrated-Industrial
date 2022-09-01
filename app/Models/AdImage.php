<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdImage extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id', 'id')->withDefault();
    }


    // Accessors use to return full url of image to use it in api
    // $ad->images  as value =====> value->image_url
    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/ad_images/' . $this->image);
    }

    // return complete image_url of image in api request to use it in mobile app
    protected $appends = [
        'image_url',
    ];


    // Hide this properties to not return it in the API request
    protected $hidden = [
        'image' , 'created_at' , 'updated_at',
    ];

}