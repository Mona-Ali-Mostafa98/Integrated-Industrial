<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{

    public function index()
    {
        $models = AdModel::orderBy('year' , 'desc')->paginate(30);

        return response()->json($models , 200);
    }

}
