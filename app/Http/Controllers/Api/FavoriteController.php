<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

public function store(Request $request)
    {
        $data = request()->validate([
            'ad_id' => 'required|exists:ads,id'
        ],[
            'ad_id.required' => 'يرجى أدخال رقم الأعلان المراد الأعجاب به',
            'ad_id.exists' => 'لابد ان يكون الأعلان المراد الأعجاب به متاح',

        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $favorite = Favorite::create($data);

        return  response()->json([
            'message' => "تم أضافة الأعلان الى المفضله بنجاح" ,
            'favorite' => $favorite->load('user:id,first_name,last_name,profile_image' , 'ad')
        ] , 201) ;
    }
}
