<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withDefault();
    }


    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id')->withDefault();
    }


    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id')->withDefault();
    }


    public function model()
    {
        return $this->belongsTo(AdModel::class, 'model_id', 'id')->withDefault();
    }

    public function images()
    {
        return $this->hasMany(AdImage::class, 'ad_id', 'id');
    }
}