<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function store(Request $request)
    {
        $data = request()->validate([
            'user_question' => 'required|string|max:255'
        ],[
            'user_question.required' => 'يرجى أدخال السؤال المراد أرساله',
            'user_question.string' => 'مطلوب ادخال السؤال مكون من حروف فقط',
            'user_question.max' => 'مطلوب ادخال السؤال لايزيد عدد حروفه عن 255 حرفا',
        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $question = Question::create($data);

        return  response()->json([
            'message' => "تم أرسال سؤالك بنجاح" ,
            'question' => $question->load('user:id,first_name,last_name,profile_image')
        ] , 201) ;
    }


}