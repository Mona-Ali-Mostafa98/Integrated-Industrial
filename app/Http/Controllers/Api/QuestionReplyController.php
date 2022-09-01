<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuestionReply;
use Illuminate\Http\Request;

class QuestionReplyController extends Controller
{


    public function store(Request $request)
    {
        $data = request()->validate([
            'user_reply' => 'required|string|max:255' ,
            'question_id' => 'required|exists:questions,id'
        ],[
            'user_reply.required' => 'يرجى أدخال السؤال المراد أرساله',
            'user_reply.string' => 'مطلوب ادخال السؤال مكون من حروف فقط',
            'user_reply.max' => 'مطلوب ادخال السؤال لايزيد عدد حروفه عن 255 حرفا',
            'question_id.required' => 'يرجى أدخال السؤال المراد الأجابه عليه',
            'question_id.exists' => 'لابد ان يكون السؤال المراد الأجابه عليه متاح',

        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $question_reply = QuestionReply::create($data);

        return  response()->json([
            'message' => "تم الأجابه على السوال بنجاح" ,
            'question_reply' => $question_reply->load('user:id,first_name,last_name,profile_image' , 'question:id,user_question')
        ] , 201) ;
    }
}
