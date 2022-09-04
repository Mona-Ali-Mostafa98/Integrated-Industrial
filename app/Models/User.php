<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_image', 'first_name' , 'last_name' , 'email',
        'mobile' ,'password' , 'country_id' , 'city_id' ,
        'address', 'address_on_map' , 'details' , 'status'
    ];


    // Accessors use to return full url of image to use it in api
    // $user->profile_image_url
    public function getProfileImageUrlAttribute()
    {
        if (Str::startsWith($this->profile_image, ['http://', 'https://'])) {
            return $this->profile_image;
        }
        return asset('storage/' . $this->profile_image);
    }

    // return complete profile_image_url of profile_image in api request to use it in mobile app
    protected $appends = [
        'profile_image_url',
        'full_name'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withDefault();
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'user_id', 'id');
    }


    // add accessor to model user to return full name
    public function getFullNameAttribute()
    {
        return "$this->first_name". " " ."$this->last_name" ;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at' , 'updated_at' , 'first_name' , 'last_name',
        'profile_image',   //hidden image and replace it with complete profile_image_url
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}