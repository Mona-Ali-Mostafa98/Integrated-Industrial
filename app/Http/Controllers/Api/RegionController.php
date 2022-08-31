<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function getRegions(Request $request)
    {
        $request->validate([
            'city_id'=>'required|exists:cities,id'
        ],[
            "city_id.required" => 'لابد من أختيار المدينه ',
            "city_id.exists" => 'هناك خطأ فى أختيار المدينه '
        ]);

        $regions= Region::where("city_id", $request->city_id)->orderBy('region_name' , 'asc')->paginate(30);

        return response()->json($regions , 200);
    }


}
