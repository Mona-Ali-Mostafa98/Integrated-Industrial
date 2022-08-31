<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::with('cities')->orderBy('country_name' , 'asc')->paginate(30);

        return response()->json($countries , 200);
    }


}