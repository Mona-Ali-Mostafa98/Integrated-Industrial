<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except('store','index');
    }

    public function index()
    {
        $user_subscribes = Subscribe::where('user_id', auth()->guard('sanctum')->user()->id)
                            ->withWhereHas('ad',function($q){
                                $q->select('id','city_id')->with('city:id,city_name');
                            })->with('user:id,first_name,last_name,profile_image')->get();

        return  response()->json([
            'user_subscribes' => $user_subscribes,
        ] , 201) ;

    }


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