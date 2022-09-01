<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $data = request()->validate([
            'ad_id' => 'required|exists:ads,id',
        ],[
            'ad_id.required' => 'يرجى أدخال رقم الأعلان المراد متابعته',
            'ad_id.exists' => 'لابد ان يكون الأعلان المراد متابعته متاح',
        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $subscribe = Subscribe::create($data);

        return  response()->json([
            'message' => "تم متابعة الأعلان بنجاح" ,
            'subscribe' => $subscribe->load('user:id,first_name,last_name,profile_image' , 'ad')
        ] , 201) ;

    }
}
