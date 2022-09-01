<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    // return list of Favorite Ads of Auth User
    public function index()
    {
        $user_favorites = Favorite::where('user_id', auth()->guard('sanctum')->user()->id)
                            ->withWhereHas('ad',function($q){
                                $q->select('id','city_id')->with('city:id,city_name');
                            })->with('user:id,first_name,last_name,profile_image')->get();

        return  response()->json([
            'user_favorites' => $user_favorites,
        ] , 201) ;

    }



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