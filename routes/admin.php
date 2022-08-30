<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/dologin', [AdminController::class, 'dologin'])->name('dologin');

    Route::middleware('isAdmin:admin')->group(function(){

        Route::resource('roles', RoleController::class);

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::resource('settings', SettingController::class)->only('index', 'show', 'update', 'edit');
        Route::resource('sliders', SliderController::class);
        Route::resource('categories', CategoryController::class);

        Route::resource('countries', CountryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('regions', RegionController::class);
        Route::post('/get_city_by_country', [RegionController::class,'getCity']);

        Route::resource('users', UserController::class);
        Route::resource('admins', AdminController::class);
        Route::resource('contact', ContactUsController::class)->only('index' , 'show' , 'destroy');

        Route::resource('models', ModelController::class);

        Route::get('/user_add_ad_view/{user}', [AdController::class, 'user_add_ad_view'])->name('user_add_ad_view');

        Route::resource('ads', AdController::class);
        Route::post('/get_subcategory_by_category', [AdController::class,'getSubCategory']);
        Route::post('/get_region_by_city', [AdController::class,'getRegion']);

        // Route::delete('/delete_image_for_ad/{ad_image}', [AdController::class, 'delete_image_for_ad'])->name('delete_image_for_ad');

});

});