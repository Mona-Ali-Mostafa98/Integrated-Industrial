<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use App\Models\AdImage;
use App\Notifications\AdNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Throwable;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }


    public function index()
    {
        $ads = Ad::with('images' , 'user:id,first_name,last_name,profile_image' , 'category:id,category_name,category_image' ,
                        'city:id,city_name' , 'region:id,region_name' ,
                        'sub_category:id,category_name,category_image' , 'model')
                        ->paginate();

        return response()->json($ads , 200);

    }



    public function store(StoreAdRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token');

            $data['user_id']= auth()->guard('sanctum')->user()->id ;

            $ad = Ad::create($data);

            // upload multi image to ad using upload image trait
            if ($images = $request->file('image')) {
                foreach($images as $image){
                    $imageName = time().rand(0,999). "." . $image->getClientOriginalExtension();
                    $image->storeAs('ad_images', $imageName ,'public');
                    $image = AdImage::create([
                        'ad_id' => $ad->id,
                        'image' => $imageName ,
                    ]);
                }
            }

            $user = auth()->guard('sanctum')->user();
            Notification::send($user, new AdNotification($ad));

            DB::commit();

            return response()->json([
                "message" => "تم أضافة الأعلان بنجاح",
                "ad" => $ad->load('images') ,
            ], 201);
        }
        catch (Throwable $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }



    public function show(Ad $ad)
    {
        // if(!empty($ad))
        // {
            return response()->json([$ad->load('user:id,first_name,last_name',
                                    'category:id,category_name,category_image' ,
                                    'city:id,city_name' ,
                                    'region:id,region_name' ,
                                    'model:id,year',
                                    'sub_category:id,category_name,category_image')
            ]);
        // }else{
        //     return response()->json([
        //         "message" => "هذا الأعلان غير موجود"
        //     ], 404);
        // }
        // Error message from controller not return SO I Changing default error message when record not found - Laravel API
    }



    public function update(UpdateAdRequest $request, Ad $ad)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token');

            $data['user_id']= auth()->guard('sanctum')->user()->id ;

            if ($images = $request->file('image')) {
                    foreach($images as $image){
                        $imageName = time().rand(0,999). "." . $image->getClientOriginalExtension();
                        $image->storeAs('ad_images', $imageName ,'public');
                        $image = AdImage::create([
                            'ad_id' => $ad->id,
                            'image' => $imageName ,
                        ]);
                    }
            }

            if(!$request->hasFile('image')){
                unset($data['image']);
            }

            $ad->update($data);

            DB::commit();

            return response()->json([
                "message" => "تم التعديل بنجاح",
                "ad" => $ad->load('images') ,
            ], 200);

        }
        catch (Throwable $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }




    public function destroy(Ad $ad)
    {
        $ad -> delete();

        return response()->json([
            'message' => "تم حذف الأعلان بنجاح !",
            // 'ad' => $ad ,
        ], 200);
    }

}