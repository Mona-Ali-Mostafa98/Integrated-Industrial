<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RateController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except('store','index');
    }


    public function index()
    {
        $user = auth()->guard('sanctum')->user() ;
        $user_rates = Rate::where('user_id', $user->id)
                            ->withWhereHas('ad',function($q){
                                $q->select('id','city_id')->with('city:id,city_name');
                            })->with('user:id,first_name,last_name,profile_image')->get();

        return  response()->json([
            'user_rates' => $user_rates,
        ] , 201) ;

    }



    public function store(Request $request)
    {
        $data = request()->validate([
            'ad_id' => 'required|exists:ads,id',
            'rate' => ['required', Rule::in(['1','2','3','4','5'])],
            'comment' => 'nullable|string|max:255'
        ],[
            'ad_id.required' => 'يرجى أدخال رقم الأعلان المراد تقييمه',
            'ad_id.exists' => 'لابد ان يكون الأعلان المراد تقييمه متاح',
            'rate.required' => 'يرجى أدخال التقييم المراد أعطاءه',
            'rate.in' => 'يرجى أختيار التقييم المراد أعطاءه1,2,3,4,5',
            'comment.string' => 'مطلوب ادخال التعليق مكون من حروف فقط',
            'comment.max' => 'مطلوب ادخال التعليق لايزيد عدد حروفه عن 255 حرفا',
        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $rate = Rate::create($data);

        return  response()->json([
            'message' => "تم أرسال تقييمك بنجاح" ,
            'rate' => $rate->load('user:id,first_name,last_name,profile_image' , 'ad')
        ] , 201) ;

    }

}

