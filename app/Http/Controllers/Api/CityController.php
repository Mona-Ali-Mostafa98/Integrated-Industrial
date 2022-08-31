<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{


    public function getCities(Request $request)
    {
        $request->validate([
            'country_id'=>'required|exists:countries,id'
        ],[
            "country_id.required" => 'لابد من أختيار الدوله ',
            "country_id.exists" => 'هناك خطأ فى أختيار الدوله '
        ]);

        $cities = City::where("country_id", $request->country_id)->orderBy('city_name' , 'asc')->paginate(30);      //  ->with('country')

        return response()->json($cities , 200);
    }


}
