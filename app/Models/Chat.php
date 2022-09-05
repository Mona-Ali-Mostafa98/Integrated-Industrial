<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user_sent_message()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id')->withDefault();
    }


    public function user_receive_message()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id')->withDefault();
    }


    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id')->withDefault();
    }


}