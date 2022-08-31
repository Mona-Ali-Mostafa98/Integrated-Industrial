<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', 'عرض')
                    ->with('parent:id,category_name,category_image')
                    ->orderBy('category_name','asc')
                    ->get();

        return response()->json($categories , 200) ;
    }


}
