<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{

// Forget password => user enter your email  and  using this function send email with unique code to reset password
    public function sendResetToken(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ],[
            'email.required' => 'مطلوب ادخال البريد الالكترونى',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.exists' => 'هناك خطأ فى البريد الالكترونى',
        ]);

        $token = rand(1000 , 9999);

        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        Mail::send('emails.forget_password',['email'=>$request->email , 'token'=>$token], function($message) use ($request) {
            $message->from('noreply@example.com' , config('app.name'));

            $message->to($request->email,'Your Email : ');

            $message->subject('أعادة تعين كلمة المرور');
        });


        return response()->json([
            'message' => 'لقد تم ارسال رابط لاعادة تعين كلمة المرور على البريد الالكترونى الخاص بك!'
        ], 200);
    }

    public function verifyFromTokenSent($token){
        $check_token = DB::table('password_resets')->where('token', $token)->first();
        // dd( $check_token);
        if(!$check_token){
            return response()->json([
                'error' => 'لقد حدث خطا ما أطلب رابط أعادة تعيين كلمة المرور مره اخرى',
            ] ,400 );
        }else{
            return response()->json([
                'message' => 'تم التاكد من الكود المرسل لك قم باعادة تعيين كلمة السر',
                'check_token' => $check_token ,
            ], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required|same:password',
        ],[
            'email.required' => 'مطلوب ادخال البريد الالكترونى',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.exists' => 'تأكد من انك مسجل بهذا البريد الالكترونى',
            'password.required' => ' مطلوب ادخال كلمة المرور',
            'password_confirmation.required' => ' مطلوب اعادة ادخال كلمة المرور',
            'password.min' => 'مطلوب ادخال كلمة المرور لاتقل عن 8 أحرف',
            'password.confirmed' => 'لابد من تاكيد كلمة المرور',
            'password_confirmation.same' => 'أعاده تاكيد كلمة المرور غير متطابقه مع كلمة المرور',
        ]);

        $user = User::where('email', $request->email)->first();

        $check_token = DB::table('password_resets')->where('email', $request->email)->first();

        // dd( $check_token);

        if(!$check_token){

            return response()->json([
                'error' => 'لقد حدث خطا ما أطلب رابط أعادة تعيين كلمة المرور مره اخرى'
            ]);

        }else{
            $user->update([
                'password' => $request->password
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return response()->json([
                'message' => 'لقد تم أعادة تعين كلمة المرور الخاصه بك بنجاح ! يمكنك الان تسجيل الدخول ' ,
            ],200);
        }
    }

// this function use to change password for auth user
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ],[
            'current_password.required' => ' مطلوب ادخال كلمة المرور الحاليه',
            'password.required' => ' مطلوب ادخال كلمة المرور',
            'password.min' => 'مطلوب ادخال كلمة المرور لاتقل عن 8 أحرف',
            'password.confirmed' => 'لابد من تاكيد كلمة المرور',
            'password_confirmation.required' => ' مطلوب اعادة ادخال كلمة المرور',
            'password_confirmation.same' => 'أعاده تاكيد كلمة المرور غير متطابقه مع كلمة المرور',
        ]);

        $auth_user = Auth::guard('sanctum')->user();

        // dd(!Hash::check($request->current_password, $auth_user->password)); =>false

        // Match The Old Password
        if(!Hash::check($request->current_password, $auth_user->password)){
            return  response()->json([
                "error" => "كلمة المرور الحاليه غير متطابقه"
            ] , 400);
        }

        $user = User::where('id', $auth_user->id)->first();

        $user->update([
            'password' => $request->password
        ]);

        return response()->json([
            'message' => 'تم تغير كلمة المرور الخاصه بك'
        ] , 200);
    }
}
