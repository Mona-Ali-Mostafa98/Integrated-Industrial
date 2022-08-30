<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function children(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault([
            'name' => 'No Parent'
        ]);
    }


    public function ads()
    {
        return $this->hasMany(Ad::class, 'category_id', 'id');
    }


        // Accessors use to return full url of category_image to use it in api
    // $category->category_image_url
    public function getCategoryImageUrlAttribute()
    {
        if (Str::startsWith($this->category_image, ['http://', 'https://'])) {
            return $this->category_image;
        }
        return asset('storage/' . $this->category_image);
    }

    // return complete category_image_url of category_image in api request to use it in mobile app
    protected $appends = [
        'category_image_url',
    ];

    protected $hidden = [
        'category_image',   //hidden image and replace it with complete category_image_url
    ];
}