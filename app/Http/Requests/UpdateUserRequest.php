<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => ['required' ,'email','max:255' , Rule::unique('users')->ignore($this->user)],
            'mobile' => ['required','string', 'min:9' ,'max:14',
                        Rule::unique('users')->ignore($this->user)],
            // 'password' => ['required', Password::min(8) ,'max:20'],           //Password::min(8)    Hash::make($data['password']

            'country_id' => ['required','exists:countries,id'],
            'city_id' => ['required','exists:cities,id'],

            'address' => 'nullable|string|max:255',
            'address_on_map' => 'nullable|url',

            'details' => 'nullable|string|max:255',

            'status' => ['required', Rule::in(['مفعل' , 'غير مفعل'])] ,

            'profile_image' => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'مطلوب ادخال الاسم الثلاثى',
            'first_name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
            'first_name.max' => 'مطلوب ادخال اسم المستخدم لايزيد عدد حروفه عن 20 حرفا',

            'last_name.required' => 'مطلوب ادخال الاسم الثلاثى',
            'last_name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
            'last_name.max' => 'مطلوب ادخال اسم المستخدم لايزيد عدد حروفه عن 20 حرفا',

            'email.required' => 'مطلوب ادخال البريد الالكترونى',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.max' => 'مطلوب ادخال بريد الكترونى لا يزيد عدد حروفه عن 255 حرفا',
            'email.unique' => 'تم التسجيل بهذا البريد الالكترونى مسبقا, قم بأدخال بريد الكترونى اخر',

            'mobile.required' => 'مطلوب ادخال رقم الجوال',
            'mobile.string' => '(+) مطلوب ادخال رقم جوال مكون من ارقام فقط ومسموح بادخال',
            'mobile.min' => ' مطلوب ادخال رقم جوال لا يقل عن 9 ارقام',
            'mobile.max' => ' مطلوب ادخال رقم جوال لا يزيد عن 14 ارقام',
            'mobile.regex' => ' هناك خطا فى رقم الجوال , يرجى ادخال رقم جوال صحيح',
            'mobile.unique' => 'تم التسجيل بهذا الرقم مسبقا, قم بأدخال رقم اخر',

            // 'password.required' => 'مطلوب ادخال كلمة المرور',
            // 'password.min' => 'مطلوب ادخال كلمة مرور لا تقل عن 8 احرف',
            // 'password.max' => ' مطلوب ادخال كلمة مرور لا يزيد عدد حروفها عن 20 ارقام',

            'country_id.required' => 'مطلوب ادخال الدوله التابع لها المنطقه المراد أضافتها ',
            'country_id.exists' => 'هناك خطأ فى أختيار الدوله ! برجاء أختيار دوله صحيحه',

            'city_id.required' => 'مطلوب ادخال المدينه التابع لها المنطقه المراد أضافتها ',
            'city_id.exists' => 'هناك خطأ فى أختيار المدينه ! برجاء أختيار مدينه صحيحه',

            'address.string' => 'مطلوب ادخال العنوان مكون من حروف فقط',
            'address.max' => ' مطلوب ادخال العنوان لا يزيد عدد حروفه عن 255 حرفا',

            'address_on_map.url' => 'يمكنك ادخال رابط لعنوانك على الخريطه ',

            'details.string' => 'مطلوب ادخال نبذه عن المستخدم مكونه من حروف فقط',
            'details.max' => ' مطلوب ادخال النبذه التعريفيه لا يزيد عدد حروفها عن 255 حرفا',

            'profile_image.image' => 'تاكد من انك قمت بادخال مسار صوره صحيح',
            'profile_image.mimes' => 'فقط jpeg,png,jpg,gif,svg مطلوب رفع صوره من نوع',
            'profile_image.max' => 'مطلوب رفع صوره لايزيد حجمها عن 2048 حرفا',

            'status.required' => 'يرجى ادخال حالة المستخدم ',
            'status.in' => 'هناك خطأ فى حالة المستخدم يرجى ادخال حالة مشرف صحيح',

        ];
    }
}