<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required|string|min:10|max:255',
            'email' => ['required' ,'email','max:255' , Rule::unique('admins')->ignore($this->admin)],
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile' => ['nullable','string', 'min:9' ,'max:14',Rule::unique('admins')->ignore($this->admin)],  //'regex:/^(009665|9665|\+9665|05|5)([013456789])([0-9]{7})$/' , =>(009665|9665|\+9665|05|5)  ((5|0|3|6|4|9|1|8|7)مفتاح الشركه) (خانات)
            'status' => ['required', Rule::in(['مفعل' , 'غير مفعل'])] ,
            'roles_name' => 'required|array'        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'مطلوب ادخال الاسم الثلاثى',
            'name.string' => 'مطلوب ادخال الاسم مكون من حروف فقط',
            'name.min' => 'مطلوب ادخال اسم المستخدم كاملا',
            'name.max' => 'مطلوب ادخال اسم المستخدم لا يزيد عدد حروفه عن 255 حرفا',

            'email.required' => 'مطلوب ادخال البريد الالكترونى',
            'email.email' => 'مطلوب ادخال بريد الكترونى صحيح',
            'email.max' => 'مطلوب ادخال بريد الكترونى لا يزيد عدد حروفه عن 255 حرفا',
            'email.unique' => 'تم التسجيل بهذا البريد الالكترونى مسبقا, قم بأدخال بريد الكترونى اخر',

            'image.sometimes' => 'مطلوب رفع صوره فى حاله عدم رفعها من قبل ',
            'image.image' => 'تاكد من انك قمت بادخال مسار صوره صحيح',
            'image.max' => 'مطلوب رفع صوره لايزيد حجمها عن 2048 حرفا',
            'image.mimes' => 'فقط jpeg,png,jpg,gif,svg مطلوب رفع صوره من نوع',

            'mobile.min' => ' مطلوب ادخال رقم هاتف لا يقل عن 9 ارقام',
            'mobile.max' => ' مطلوب ادخال رقم هاتف لا يزيد عن 14 ارقام',
            // 'mobile.regex' => ' هناك خطا فى رقم الهاتف , يرجى ادخال رقم هاتف صحيح',
            'mobile.unique' => 'تم التسجيل بهذا الرقم مسبقا, قم بأدخال رقم اخر',

            'status.required' => 'يرجى ادخال حالة المشرف ',
            'status.in' => 'هناك خطأ فى حالة المشرف يرجى ادخال حالة مشرف صحيح',

            'roles_name.required' => 'يرجى ادخال صلاحيات المشرف ',

        ];
    }
}