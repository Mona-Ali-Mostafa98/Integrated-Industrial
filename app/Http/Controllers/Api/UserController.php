<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    use UploadImageTrait;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store','create_access_token' , 'show');
    }

    // this funaction use to create new account for user
    public function store(StoreUserRequest $request)
    {
        $request->validate([
            'password' => ['confirmed'],
            'password_confirmation'=>'required|same:password',
        ],[
            'password.confirmed' => 'لابد من تاكيد كلمة المرور',
            'password_confirmation.required' => ' مطلوب اعادة ادخال كلمة المرور',
            'password_confirmation.same' => 'أعاده تاكيد كلمة المرور غير متطابقه مع كلمة المرور',
        ]);

        $data = $request->except('profile_image' , '_token');

        $data['profile_image'] = $this->uploadImage($request, 'profile_image', 'users');

        $user = User::create($data);

        return  response()->json([
            'message' => "تم انشاء الحساب بنجاح" ,
            'user' => $user->load('country','city')
        ] , 201) ;
    }


    // this function use to user make login and return access token for you
    public function create_access_token(Request $request)
    {

        $request -> validate([
            'email'=> 'required|email|exists:users,email',
            'password'=> 'required|string|min:8',
            'device_name' => 'string|max:255',
            // 'abilities' => 'nullable|array'

        ],[
            'email.required' => ' مطلوب ادخال البريد الالكترونى',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.exists' => 'هناك خطأ فى البريد الالكترونى',
            'password.required' => 'مطلوب ادخال كلمة المرور',
            'password.min' => 'مطلوب ادخال كلمة المرور لا تقل عن 8 أحرف',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $device_name = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($device_name);  //, $request->post('abilities')

            return response()->json([
                'message' => 'تم تسجيل الدخول بنجاح',
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);

        }

        return response()->json([
            'message' => 'تاكد من عنوان البريد الالكترونى وكلمة المرور',
        ], 401);

    }

// function destroy_token used to logout and destroy toke
    public function destroy_token($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        if ( $token === null) {
            Auth::user()->tokens->each(function($token, $key) {
                $token->delete();
            });
            return response()->json([
                'message'=> 'تم تسجيل الخروج بنجاح'
            ], 200);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);
        if (
            $user->id == $personalAccessToken->tokenable_id
            && get_class($user) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
        }
    }

// Show Profile of any user
    public function show(User $user)
    {
        return  response()->json([
            'user' => $user->load('ads','country','city')
        ] , 200) ;
    }


    public function update(UpdateUserRequest $request , User $user)
    {
        $old_image = $user->profile_image;
        $data = $request->except('profile_image' , '_token');

        $data['profile_image'] = $this->uploadImage($request, 'profile_image', 'users');

        if(!$request->hasFile('profile_image')){
            unset($data['profile_image']);
        }

        $user->update($data);

        if ($old_image && isset($data['profile_image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return  response()->json([
            'message' => "تم التعديل بنجاح" ,
            'user' => $user->load('country','city')
        ] , 200) ;
    }



    public function destroy(User $user)
    {
        $user -> delete();
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        return response()->json([
            'message' => "تم حذف الحساب بنجاح" ,
        ] , 200) ;
    }


}