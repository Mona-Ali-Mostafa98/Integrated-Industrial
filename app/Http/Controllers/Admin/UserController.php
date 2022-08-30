<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Ad;
use App\Models\City;
use App\Models\Comment;
use App\Models\Complain;
use App\Models\Country;
use App\Models\Favorite;
use App\Models\Question;
use App\Models\QuestionReply;
use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $users = User:: simplePaginate();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        $countries = Country::all();
        $city = City::where('id',$user->city_id)->first(); //use  to return city that user belongs to in edit form

        return view('admin.users.create' , compact('user' , 'countries' , 'city'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->except('profile_image' , '_token');

        $data['profile_image'] = $this->uploadImage($request, 'profile_image', 'users');

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success' , "تم الاضافه بنجاح");
    }

    public function show(User $user)
    {
        $user_ads = Ad::where('user_id' , $user->id)->get();
        $user_questions = Question::where('user_id' , $user->id)->simplePaginate();
        $user_replies = QuestionReply::where('user_id' , $user->id)->simplePaginate();
        $user_favorites = Favorite::where('user_id' , $user->id)->with('user')->with('ad')->simplePaginate();
        $user_comments = Comment::where('user_id' , $user->id)->with('user')->with('ad')->simplePaginate();
        $user_complains = Complain::where('user_id' , $user->id)->with('user')->with('ad')->simplePaginate();

        return view('admin.users.show', compact('user' , 'user_ads', 'user_questions' , 'user_replies' , 'user_favorites' , 'user_comments' , 'user_complains'));
    }

    public function edit(User $user)
    {
        $countries = Country::all();
        $city = City::where('id',$user->city_id)->first();

        return view('admin.users.edit', compact('user' , 'countries' , 'city'));
    }

    public function update(UpdateUserRequest $request , User $user)
    {
        $old_image = $user->profile_image;
        $data = $request->except('profile_image' , '_token');

        $data['profile_image'] = $this->uploadImage($request, 'profile_image', 'users');

        if(!$request->hasFile('profile_image')){
            unset($data['profile_image']);
        }

        $user->update($data);

        if ($old_image && isset($data['profile_image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.users.index')
            ->with('success',"تم التعديل بنجاح");
    }

    public function destroy(User $user)
    {
        $user -> delete();
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        return redirect()->route('admin.users.index')
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

    public function user_question(User $user)
    {
        $user_questions = Question::where('user_id' , $user->id)->simplePaginate();
        dd($user_questions);
        return view('admin.users.index', compact('user_questions'));
    }


}