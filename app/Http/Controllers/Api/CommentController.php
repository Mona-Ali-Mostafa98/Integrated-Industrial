<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $data = request()->validate([
            'ad_id' => 'required|exists:ads,id',
            'comment' => 'required|string|max:255'

        ],[
            'ad_id.required' => 'يرجى أدخال رقم الأعلان المراد التعليق عليه',
            'ad_id.exists' => 'لابد ان يكون الأعلان المراد التعليق عليه متاح',
            'comment.required' => 'يرجى أدخال التعليق المراد أرساله',
            'comment.string' => 'مطلوب ادخال التعليق مكون من حروف فقط',
            'comment.max' => 'مطلوب ادخال التعليق لايزيد عدد حروفه عن 255 حرفا',
        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $comment = Comment::create($data);

        return  response()->json([
            'message' => "تم أرسال التعليق الخاص بك بنجاح" ,
            'comment' => $comment->load('user:id,first_name,last_name,profile_image' , 'ad')
        ] , 201) ;

    }


}
