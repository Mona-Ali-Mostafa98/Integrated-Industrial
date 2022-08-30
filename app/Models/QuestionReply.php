<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionReply extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }


    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id')->withDefault();
    }

}