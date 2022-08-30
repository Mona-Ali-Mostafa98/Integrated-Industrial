<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use UploadImageTrait;

        function __construct()
    {
        $this->middleware('permission:الاعدادات', ['only' => ['index']]);
        $this->middleware('permission:عرض الاعدادات', ['only' => ['show']]);
        $this->middleware('permission:تعديل الاعدادات', ['only' => ['edit','update']]);
    }



    public function index()
    {
        $setting = Setting:: first() ;
        // dd($settings);
        return view('admin.settings.index', compact('setting'));
    }

    public function show(Setting $setting)
    {
        return view('admin.settings.show', compact('setting'));
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update (UpdateSettingRequest $request , Setting $setting)
    {
        $old_logo = $setting->logo;
        $data = $request->except('logo' , '_token');

        $data['logo'] = $this->uploadImage($request, 'logo', 'settings');

        if(!$request->hasFile('image')){
            unset($data['image']);
        }
        if(!$request->hasFile('logo')){
            unset($data['logo']);
        }

        if ($old_logo && isset($data['logo'])) {
            Storage::disk('public')->delete($old_logo);
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index')
            ->with('success' , "تم التعديل بنجاح");
    }
}