<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:قائمة السليدرز', ['only' => ['index']]);
        $this->middleware('permission:عرض سليدر', ['only' => ['show']]);
        $this->middleware('permission:أضافة سليدر', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل سليدر', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف سليدر', ['only' => ['destroy']]);
    }


    public function index()
    {
        $sliders = Slider:: all();
        return view('admin.sliders.index', compact('sliders'));
    }


    public function create()
    {
        $slider = new Slider() ;
        return view('admin.sliders.create' , compact('slider'));
    }



    public function store(SliderRequest $request)
    {
        $data = $request->except('_token');

        $slider = Slider::create($data);
        return redirect()->route('admin.sliders.index')
            ->with('success' , "تمت الاضافه بنجاح");

    }

    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider') );
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderRequest $request,Slider $slider)
    {
        $data = $request->except('_token');

        $slider->update($data);

        return redirect()->route('admin.sliders.index')
            ->with('success',"تم التعديل بنجاح");
    }

    public function destroy(Slider $slider)
    {
        $slider -> delete();

        return redirect()->route('admin.sliders.index')
            ->with('success' , "تم الحذف بنجاح");
    }
}