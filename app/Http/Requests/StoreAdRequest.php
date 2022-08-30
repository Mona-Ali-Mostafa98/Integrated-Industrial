<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => ['required','exists:categories,id'],
            'user_id' => ['required','exists:users,id'],
            'city_id' => ['required','exists:cities,id'],
            'region_id' => ['required','exists:regions,id'],
            'subcategory_id' => ['required','exists:categories,id'],
            'model_id' => ['required','exists:ad_models,id'],
            'mobile' => ['required','string', 'min:9' ,'max:14'],
            'price' => ['required','integer'],
            'description' => ['required','string', 'max:1000' ],
            'image' => 'required|array|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'hide_mobile' =>'nullable'
        ];
    }


    public function messages()
    {
        return [
            'category_id.required' => 'مطلوب ادخال القسم التابع له الاعلان المراد أضافته ',
            'category_id.exists' => 'هناك خطأ فى أختيار القسم ! برجاء أختيار فسم صحيح',

            'user_id.required' => 'لابد من ان يكون هناك مستخدم ليقوم بأضافة اعلان',
            'user_id.exists' => 'هناك خطأ فى أختيار المستخدم ! برجاء انشاء حساب اولا اذا لم يكن لديك حساب',

            'city_id.required' => 'مطلوب ادخال المدينه المراد نشر الاعلان بها ',
            'city_id.exists' => 'هناك خطأ فى أختيار المدينه ! برجاء أختيار مدينه صحيحه',

            'region_id.required' => 'مطلوب ادخال المنطقه المراد نشر الاعلان بها ',
            'region_id.exists' => 'هناك خطأ فى أختيار المنطقه ! برجاء أختيار منطقه صحيحه',

            'subcategory_id.required' => 'مطلوب ادخال القسم الفرعى التابع له الاعلان المراد أضافته ',
            'subcategory_id.exists' => 'هناك خطأ فى أختيار القسم الفرعى ! برجاء أختيار فسم صحيح',

            'model_id.required' => 'مطلوب ادخال الموديل الخاص بالاعلان  ',
            'model_id.exists' => 'هناك خطأ فى أختيار الموديل ! برجاء أختيار مدينه صحيح',

            'mobile.required' => ' مطلوب ادخال رقم الجوال',
            'mobile.min' => ' مطلوب ادخال رقم الجوال لا يقل عن 9 ارقام',
            'mobile.max' => ' مطلوب ادخال رقم الجوال لا يزيد عن 14 ارقام',

            'price.required' => 'مطلوب ادخال السعر ',
            'price.integer' => 'مطلوب ادخال السعر مكون من ارقام فقط',

            'description.required' => 'مطلوب ادخال وصف للاعلان ',
            'descriptionٍٍس.string' => 'مطلوب ادخال وصف الاعلان مكون من حروف فقط',
            'description.max' => 'مطلوب ادخال وصف الاعلان لايزيد عدد حروفه عن 1000 حرفا',

            'image.required' => 'مطلوب رفع صوره ',
            'image.image' => 'تاكد من انك قمت بادخال مسار صوره صحيح',
            'image.max' => 'مطلوب رفع صوره لايزيد حجمها عن 2048 حرفا',
            'image.mimes' => 'فقط jpeg,png,jpg,gif,svg مطلوب رفع صوره من نوع',

        ];
    }
}