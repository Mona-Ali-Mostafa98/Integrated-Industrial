<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:|اضافة صلاحيه|تعديل صلاحيه|حذف صلاحيه', ['only' => ['index','store']]);
        $this->middleware('permission:أضافة صلاحيه', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل صلاحيه', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف صلاحيه', ['only' => ['destroy']]);
    }



    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $role = new Role();
        $permissions = Permission::get();
        return view('admin.roles.create',compact('permissions' , 'role'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name|string|max:255',
            'permission' => 'array|required',
        ],[
            'name.required' => 'مطلوب ادخال أسم الصلاحيه',
            'name.unique' => 'لقد تم استخدام أسم الصلاحيه من قبل برجاء ادخال اسم اخر',
            'name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
            'name.max' => 'مطلوب ادخال اسم الصلاحيه لا يزيد عدد حروفه عن 255 حرفا',
            'permission.required' => 'مطلوب ادخال الصلاحيات المسموح بها',

        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')
                        ->with('success','تم أنشاء صلاحيه جديده بنجاح');
    }


    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        // dd($rolePermissions);
        return view('admin.roles.show',compact('role','rolePermissions'));
    }


    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit',compact('role','permissions','rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'permission' => 'required',
        ],[
            'name.required' => 'مطلوب ادخال أسم الصلاحيه',
            'name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
            'name.max' => 'مطلوب ادخال اسم الصلاحيه لا يزيد عدد حروفه عن 255 حرفا',
            'permission.required' => 'مطلوب ادخال الصلاحيات المسموح بها',

        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')
                        ->with('success','تم التعديل على الصلاحيه بنجاح');
    }


    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('admin.roles.index')
            ->with('success','تم حذف الصلاحيه بنجاح');
    }
}