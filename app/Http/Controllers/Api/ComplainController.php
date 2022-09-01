<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComplainController extends Controller
{

    public function store(Request $request)
    {
        $data = request()->validate([
            'ad_id' => 'required|exists:ads,id',
            'status' => ['required', Rule::in(['خطأ فى السعر', 'أعلان غير لائق', 'أعلان غير  مناسب' , 'أحتيال' ])]
        ],[
            'ad_id.required' => 'يرجى أدخال رقم الأعلان المراد تقديم بلاغ به',
            'ad_id.exists' => 'لابد ان يكون الأعلان المراد تقديم بلاغ به متاح',
            'status.required' => 'يرجى أدخال سبب الشكوى المرسله',
            'status.in' => 'يرجى أختيار سبب الشكوى المرسله',
        ]);

        $data['user_id']= auth()->guard('sanctum')->user()->id ;

        $complain = Complain::create($data);

        return  response()->json([
            'message' => "تم أرسال الشكوى بنجاح" ,
            'complain' => $complain->load('user:id,first_name,last_name,profile_image' , 'ad')
        ] , 201) ;
    }


}