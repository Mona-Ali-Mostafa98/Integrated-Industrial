<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ComplainController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ModelController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionReplyController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Get Current Authentication User
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); //Auth::guard('sanctum')->user
});

Route::get('settings' , [SettingController::class , 'index']);

Route::apiResource('sliders' , SliderController::class);

Route::apiResource('categories' , CategoryController::class);

Route::apiResource('ads' , AdController::class);

Route::post('contact_us' , [ContactUsController::class , 'store']);

Route::get('countries' , [CountryController::class , 'index']);
Route::post('cities', [CityController::class, 'getCities']);
Route::post('regions', [RegionController::class, 'getRegions']);

Route::get('models', [ModelController::class, 'index']);

Route::apiResource('users' , UserController::class);

Route::post('auth/access_tokens' , [UserController::class , 'create_access_token'])->middleware('guest:sanctum');

// route used to destroy token and logout
Route::delete('auth/access-tokens/{token?}', [UserController::class, 'destroy_token'])->middleware('auth:sanctum');

Route::post('questions' , [QuestionController::class , 'store'])->middleware('auth:sanctum');

Route::post('questions_replies' , [QuestionReplyController::class , 'store'])->middleware('auth:sanctum');

Route::get('favorites' , [FavoriteController::class , 'index'])->middleware('auth:sanctum');
Route::post('favorites' , [FavoriteController::class , 'store'])->middleware('auth:sanctum');

Route::post('comments' , [CommentController::class , 'store'])->middleware('auth:sanctum');

Route::post('complains' , [ComplainController::class , 'store'])->middleware('auth:sanctum');

Route::get('rates' , [RateController::class , 'index'])->middleware('auth:sanctum');
Route::post('rates' , [RateController::class , 'store'])->middleware('auth:sanctum');

Route::get('subscribes' , [SubscribeController::class , 'index'])->middleware('auth:sanctum');
Route::post('subscribes' , [SubscribeController::class , 'store'])->middleware('auth:sanctum');

Route::get('send-notification' , [NotificationController::class , 'notifications'])->middleware('auth:sanctum');


Route::get('user/activation/{token}', [UserController::class , 'userActivation']);


Route::post('messages', [ChatController::class, 'message'])->middleware('auth:sanctum');


Route::post('send_token_to_reset_password',[PasswordController::class,'sendResetToken']);
Route::post('verify_from_token_sent/{token}',[PasswordController::class,'verifyFromTokenSent']);
Route::post('reset_password',[PasswordController::class,'resetPassword']);

Route::post('change_password', [PasswordController::class, 'changePassword'])->middleware('auth:sanctum');