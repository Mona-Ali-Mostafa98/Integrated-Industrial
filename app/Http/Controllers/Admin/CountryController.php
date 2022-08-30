<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:قائمة الدول', ['only' => ['index']]);
        $this->middleware('permission:عرض دوله', ['only' => ['show']]);
        $this->middleware('permission:أضافة دوله', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل دوله', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف دوله', ['only' => ['destroy']]);
    }


    public function index()
    {
        $countries = Country::orderBy('country_name','asc')->paginate();
        return view('admin.countries.index', compact('countries'));
    }



    public function create()
    {
        $country = new Country();
        return view('admin.countries.create' , compact('country'));
    }



    public function store(CountryRequest $request)
    {
        $data = $request->except('_token');

        Country::create($data);

        return redirect()->route('admin.countries.index')
            ->with('success' , "تم الاضافه بنجاح");

    }



    public function show(Country $country)
    {
        return view('admin.countries.show', compact('country') );
    }



    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }



    public function update(CountryRequest $request , Country $country)
    {
        $data = $request->except('_token');

        $country->update($data);

        return redirect()->route('admin.countries.index')
            ->with('success',"تم التعديل بنجاح");
    }


    public function destroy(Country $country)
    {
        $country -> delete();
        return redirect()->route('admin.countries.index')
            ->with('success' , "تم الحذف بنجاح");
    }


}
