<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:قائمة المشرفين', ['only' => ['index']]);
        $this->middleware('permission:عرض مشرف', ['only' => ['show']]);
        $this->middleware('permission:أضافة مشرف', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل مشرف', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مشرف', ['only' => ['destroy']]);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function dologin(Request $request)
    {
        $data = $request -> validate([
            'email'=> 'required|email|exists:admins,email',
            'password'=> 'required | string',
        ],[
            'email.required' => ' مطلوب ادخال البريد الالكترونى',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.exists' => 'هناك خطأ فى البريد الالكترونى',
            'password.required' => 'مطلوب ادخال كلمة المرور',
        ]);
        // dd(!auth()->guard('admin')-> attempt(['email'=> $data['email'],'password'=> $data['password']]));
        if(!auth()->guard('admin')-> attempt(['email'=> $data['email'],'password'=> $data['password']]))
        {
            return back();
        }
        else
        {
            return redirect()->route('admin.dashboard')->with('success' , 'تم تسجيل الدخول بنجاح');

        }
    }

    public function logout()
    {
        auth()->guard('admin')-> logout() ;
        return redirect(route('admin.login'));

    }

    public function index()
    {
        $admins = Admin:: all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $admin = new Admin();
        //$roles = Role::pluck('name','name')->all();   // return only name when access it we will use   @foreach ($roles as $role) and use $role not $role->name
        $roles = Role::all();   //like owner - admin - super admin
        return view('admin.admins.create' , compact('admin' , 'roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $data = $request->except('image' , '_token');

        $data['image'] = $this->uploadImage($request, 'image', 'admins');

        $admin = Admin::create($data);

        $admin->assignRole($request->input('roles_name'));

        return redirect()->route('admin.admins.index')
            ->with('success' , "تمت الاضافة بنجاح");
    }

    public function show(Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();   //return owner - admin ...
        $adminRole = $admin->roles->all();  //return admin role => owner or admin ...
        return view('admin.admins.edit', compact('admin' , 'roles' ,'adminRole'));
    }

    public function update(UpdateAdminRequest $request , Admin $admin)
    {

        $old_image = $admin->image;
        $data = $request->except('image' , '_token');

        $data['image'] = $this->uploadImage($request, 'image', 'admins');

        if(!$request->hasFile('image')){
            unset($data['image']);
        }

        $admin->update($data);

        DB::table('model_has_roles')->where('model_id',$admin->id)->delete();

        $admin->assignRole($request->input('roles_name'));

        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.admins.index')
            ->with('success',"تم التعديل بنجاح");

    }

    public function destroy(Admin $admin)
    {
        $admin -> delete();
        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }
        return redirect()->route('admin.admins.index')
            ->with('success' , "تم الحذف بنجاح");

    }



}