<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => ['required','string', 'min:10' ,'max:255'],
            'email' => ['required','string' , 'email'],
            'mobile' => ['required','string', 'min:9' ,'max:14'],
            'message' => ['required' , 'string'],
        ];
    }

    public function messages()
    {
        return [
        'name.required' => 'مطلوب ادخال اسم المرسل',
        'name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
        'name.min' => 'مطلوب ادخال الأسم الثلاثي المستخدم ',
        'name.max' => 'مطلوب ادخال اسم المستخدم لا يزيد عدد حروفه عن 255 حرفا',

        'email.required' => 'مطلوب ادخال البريد الالكترونى',
        'name.min' => 'مطلوب ادخال اسم المستخد كاملا',
        'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
        'mobile.min' => ' مطلوب ادخال رقم هاتف لا يقل عن 9 ارقام',
        'mobile.max' => ' مطلوب ادخال رقم هاتف لا يزيد عن 14 ارقام',
        'message.required' => 'مطلوب ادخال نص الرساله',
        'name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
        ];
    }
}