<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'logo' => ['sometimes','required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'title' => ['sometimes','required','string','max:255'],
            'about_us' => ['sometimes','required','string'],
            'mobile' => ['nullable','string'],
            'email' => ['sometimes','required','email','max:255','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'forbidden_ads' => ['sometimes','required','string'],
        ];
    }

    public function messages()
    {
        return [
            'logo.sometimes' => 'مطلوب رفع صوره لوجو الموقع فى حاله عدم رفعها من قبل ',
            'logo.image' => 'تاكد من انك قمت بادخال مسار صوره لوجو الموقع بشكل صحيح',
            'logo.max' => 'مطلوب رفع صوره لوجو لايزيد حجمها عن 2048 حرفا',
            'logo.mimes' => 'فقط jpeg,png,jpg,gif,svg مطلوب رفع صوره لوجو من نوع',

            'title.required' => 'مطلوب ادخال العنوان ',
            'title.string' => 'مطلوب ادخال العنوان مكون من حروف فقط',
            'title.max' => 'مطلوب ادخال العنوان لايزيد عدد حروفه عن 255 حرفا',

            'about_us.required' => 'مطلوب ادخال نبذه تعريفيه هن التطبيق',
            'about_us.string' => 'مطلوب ادخال حروف فقط',

            'mobile.max' => 'مطلوب ادخال رقم الجوال لا يزيد عدد حروفه عن 255 حرفا',

            'email.required' => 'مطلوب ادخال البريد الالكترونى للتطبيق',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.max' => 'مطلوب ادخال بريد الكترونى لا يزيد عدد حروفه عن 255 حرفا',
            'email.regex' => 'مطلوب ادخال بريد الكترونى صحيح',

            'forbidden_ads.required' => 'مطلوب توضيح نوع الاعلانات الممنوعه فى التطبيق ',
            'forbidden_ads.string' => 'مطلوب توضيح نوع الاعلانات الممنوعه فى التطبيق  مكون من حروف فقط',

        ];
    }

}
