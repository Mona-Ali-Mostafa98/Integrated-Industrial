<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function index()
    {
        $regions = Region::orderBy('region_name','asc')->paginate();
        return view('admin.regions.index', compact('regions'));
    }



    public function create()
    {
        $region = new Region();
        $countries = Country::all();
        $city = City::where('id',$region->city_id)->first(); //use  to return city that region belongs to in edit form

        return view('admin.regions.create' , compact('region' , 'countries' , 'city'));
    }



    public function store(RegionRequest $request)
    {
        $data = $request->except('_token');

        Region::create($data);

        return redirect()->route('admin.regions.index')
            ->with('success' , "تم الاضافه بنجاح");

    }



    public function show(Region $region)
    {
        return view('admin.regions.show', compact('region') );
    }



    public function edit(Region $region)
    {
        $countries = Country::all();
        $city = City::where('id',$region->city_id)->first();

        return view('admin.regions.edit', compact('region' , 'countries' , 'city'));
    }



    public function update(RegionRequest $request , Region $region)
    {
        $data = $request->except('_token');

        $region->update($data);

        return redirect()->route('admin.regions.index')
            ->with('success',"تم التعديل بنجاح");
    }


    public function destroy(Region $region)
    {
        $region -> delete();
        return redirect()->route('admin.regions.index')
            ->with('success' , "تم الحذف بنجاح");
    }


    // this function using in country and city dropdown using ajax
    public function getCity(Request $request){
		$country_id = $request->post('country_id');
		$cities = City::where('country_id',$country_id)->orderBy('city_name','asc')->get();
		$html='<option value="">برجاء أختيار المدينه التابعه لها المنطقه المراد أضافتها</option>';
		foreach($cities as $city){
			$html.='<option value="'.$city->id.'">'.$city->city_name.'</option>';
		}
		echo $html;
	}

}
