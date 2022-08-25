<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:قائمة الاقسام', ['only' => ['index']]);
        $this->middleware('permission:عرض قسم', ['only' => ['show']]);
        $this->middleware('permission:أضافة قسم', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Category:: all() ;
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $category = new Category() ;
        $categories = Category::all();

        return view('admin.categories.create' , compact('category' , 'categories'));
    }


    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except('category_image' , '_token');

        $data['category_image'] = $this->uploadImage($request, 'category_image', 'categories');

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success' , "تم الاضافه بنجاح");
    }



    public function show(Category $category)
    {
        return view('admin.categories.show',compact('category'));
    }



    public function edit(Category $category)
    {
        //add query to prevent selected category want to update and his children show in field of parent_id edit form blade
        $categories = Category::where('id' , '!=' , $category->id)
            ->where(function($query) use ($category){
                $query->where('parent_id' , '<>' , $category->id)
                ->orWhereNull('parent_id');
            })
            ->get(); //^ "select * from `categories` where `id` != ? and (`parent_id` <> ? or `parent_id` is null)"

        return view('admin.categories.edit' ,compact('category' , 'categories'));
    }



    public function update(UpdateCategoryRequest $request , Category $category)
    {
        $old_image = $category->category_image;
        $data = $request->except('category_image' , '_token');

        $data['category_image'] = $this->uploadImage($request, 'category_image', 'categories');

        if(!$request->hasFile('category_image')){
            unset($data['category_image']);
        }

        $category->update($data);

        if ($old_image && isset($data['category_image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.categories.index')
            ->with('success',"تم التعديل بنجاح");
    }



    public function destroy(Category $category)
    {
        $category -> delete();
        if ($category->category_image) {
            Storage::disk('public')->delete($category->category_image);
        }
        return redirect()->route('admin.categories.index')
            ->with('success' , "تم الحذف بنجاح");
    }
}