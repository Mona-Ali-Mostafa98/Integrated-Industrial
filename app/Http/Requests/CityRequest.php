<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
            'country_id' => ['required','exists:countries,id'],
            'city_name' => ['required','string', 'max:255' , Rule::unique('cities')->ignore($this->city)],
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => 'مطلوب ادخال الدوله التابع لها المدينه المراد أضافتها ',
            'country_id.exists' => 'هناك خطأ فى أختيار الدوله ! برجاء أختيار دوله صحيحه',

            'city_name.required' => 'مطلوب ادخال أسم المدينه ',
            'city_name.string' => 'مطلوب ادخال أسم المدينه مكون من حروف فقط',
            'city_name.max' => 'مطلوب ادخال أسم المدينه لايزيد عدد حروفه عن 255 حرفا',
            'city_name.unique' => 'لقد تم أستخدام أسم المدينه مسبقا برجاء أدخال اسم اخر',


        ];
    }
}