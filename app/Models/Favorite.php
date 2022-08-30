<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id', 'id')->withDefault();
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }


}