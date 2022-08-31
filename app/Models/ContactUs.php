<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Hide this properties to not return it in the API request
    protected $hidden = [
        'created_at' , 'updated_at',
    ];
}
