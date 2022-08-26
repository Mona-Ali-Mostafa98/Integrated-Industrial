<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::orderBy('city_name','asc')->paginate();
        return view('admin.cities.index', compact('cities'));
    }



    public function create()
    {
        $city = new City();
        $countries = Country::all();
        return view('admin.cities.create' , compact('city' , 'countries'));
    }



    public function store(CityRequest $request)
    {
        $data = $request->except('_token');

        City::create($data);

        return redirect()->route('admin.cities.index')
            ->with('success' , "تم الاضافه بنجاح");

    }



    public function show(City $city)
    {
        return view('admin.cities.show', compact('city') );
    }



    public function edit(City $city)
    {
        $countries = Country::all();
        return view('admin.cities.edit', compact('city' , 'countries'));
    }



    public function update(CityRequest $request , City $city)
    {
        $data = $request->except('_token');

        $city->update($data);

        return redirect()->route('admin.cities.index')
            ->with('success',"تم التعديل بنجاح");
    }


    public function destroy(City $city)
    {
        $city -> delete();
        return redirect()->route('admin.cities.index')
            ->with('success' , "تم الحذف بنجاح");
    }


}