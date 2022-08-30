<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use App\Models\AdImage;
use App\Models\AdModel;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AdController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:قائمة الاعلانات', ['only' => ['index']]);
        $this->middleware('permission:عرض أعلان', ['only' => ['show']]);
        $this->middleware('permission:أضافة أعلان', ['only' => ['create', 'user_add_ad_view' ,'store']]);
        $this->middleware('permission:تعديل أعلان', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف أعلان', ['only' => ['destroy']]);
    }



    public function index()
    {
        $ads = Ad::paginate();
        return view('admin.ads.index', compact('ads'));
    }


// return create ad view for admin
    public function create()
    {
        $ad = new Ad();
        $user = Auth::guard('admin')->user();  //return admin login in dashboard to allow admin add ads
        $categories = Category::all();
        $cities = City::all();
        $region = Region::where('id' , $ad->region_id)->first(); //use  to return region that ad belongs to in edit form
        $models = AdModel::all();
        $subcategory = Category::where('id',$ad->subcategory_id)->first();

        return view('admin.ads.create' , compact('ad' , 'user' ,'categories', 'cities' , 'region' , 'models' , 'subcategory'));
    }



    public function store(StoreAdRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token');

            $ad = Ad::create($data);

            // upload multi image to ad using upload image trait
            if ($images = $request->file('image')) {
                foreach($images as $image){
                    $imageName = time().rand(0,999). "." . $image->getClientOriginalExtension();
                    $image->storeAs('ad_images', $imageName ,'public');
                    $image = AdImage::create([
                        'ad_id' => $ad->id,
                        'image' => $imageName ,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.ads.index')
                ->with('success' , "تم الاضافه بنجاح");

        }
        catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function show(Ad $ad)
    {
        return view('admin.ads.show', compact('ad') );
    }



    public function edit(Ad $ad)
    {
        $user = Auth::guard('admin')->user();
        $categories = Category::all();
        $cities = City::all();
        $region = Region::where('id',$ad->region_id)->first();
        $models = AdModel::all();
        $subcategory = Category::where('id',$ad->subcategory_id)->first();

        return view('admin.ads.edit', compact('ad' , 'user' , 'categories' , 'models' , 'cities' , 'region' , 'subcategory'));
    }



    public function update(UpdateAdRequest $request , Ad $ad)
    {
        // $old_image[] = AdImage::where('ad_id' , $ad->id)->get();
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token');

            if ($images = $request->file('image')) {
                    foreach($images as $image){
                        $imageName = time().rand(0,999). "." . $image->getClientOriginalExtension();
                        $image->storeAs('ad_images', $imageName ,'public');
                        $image = AdImage::create([
                            'ad_id' => $ad->id,
                            'image' => $imageName ,
                        ]);
                    }
            }

            if(!$request->hasFile('image')){
                unset($data['image']);
            }

            $ad->update($data);

            DB::commit();

            return redirect()->route('admin.ads.index')
                ->with('success',"تم التعديل بنجاح");

        }
        catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

    }


    public function destroy(Ad $ad)
    {
        $ad -> delete();

        return redirect()->route('admin.ads.index')
            ->with('success' , "تم الحذف بنجاح");
    }


    // this function using to return region by city dropdown using ajax
    public function getRegion(Request $request){
		$city_id = $request->post('city_id');
		$regions = Region::where('city_id',$city_id)->orderBy('region_name','asc')->get();
		$html='<option value="">برجاء أختيار المنطقه المراد أضافة الأعلان بها</option>';
		foreach($regions as $region){
			$html.='<option value="'.$region->id.'">'.$region->region_name.'</option>';
		}
		echo $html;
	}


    // this function using to return subCategory after choose main category using ajax
    public function getSubCategory(Request $request){
		$category_id = $request->post('category_id');
		$sub_categories = Category::where('parent_id',$category_id)->orderBy('category_name','asc')->get();
		$html='<option value="">برجاء أختيار القسم الفرعى المراد أضافة الاعلان له</option>';
		foreach($sub_categories as $sub_category){
			$html.='<option value="'.$sub_category->id.'">'.$sub_category->category_name.'</option>';
		}
		echo $html;
	}


    // return ad create view for add ads for specific user
    public function user_add_ad_view(User $user)
    {
        $ad = new Ad();
        $categories = Category::all();
        $cities = City::all();
        $region = Region::where('id' , $ad->region_id)->first(); //use  to return region that ad belongs to in edit form
        $models = AdModel::all();
        $subcategory = Category::where('id',$ad->subcategory_id)->first();

        return view('admin.ads.create', compact('user' , 'ad' ,'categories', 'cities' , 'region' , 'models' , 'subcategory'));

    }
}