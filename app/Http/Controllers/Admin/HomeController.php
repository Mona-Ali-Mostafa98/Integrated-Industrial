<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Admin;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الصفحه الرئيسيه', ['only' => ['dashboard']]);
    }

    public function dashboard(){
        $users_count = User:: count();
        $admins_count = Admin:: count();
        $categories_count = Category:: count();
        $ads_count = Ad:: count();
        $admins = Admin::latest()->take(6)->get();

        return view('admin.dashboard' , compact('users_count' , 'admins_count' , 'categories_count' , 'ads_count' , 'admins'));
    }
}