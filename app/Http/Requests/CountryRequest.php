<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
            'country_name' => ['required','string', 'max:255' ,Rule::unique('countries')->ignore($this->country)],
            'country_code' => ['required','string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'country_name.required' => 'مطلوب ادخال أسم الدوله ',
            'country_name.string' => 'مطلوب ادخال أسم الدوله مكون من حروف فقط',
            'country_name.max' => 'مطلوب ادخال أسم الدوله لايزيد عدد حروفه عن 255 حرفا',
            'country_name.unique' => 'لقد تم أستخدام أسم الدوله مسبقا برجاء أدخال اسم اخر',

            'country_code.required' => 'مطلوب ادخال كود الدوله',
            'country_code.string' => 'مطلوب ادخال كود الدوله مكون من حروف فقط',
            'country_code.max' => 'مطلوب ادخال كود الدوله لايزيد عدد حروفه عن 255 حرفا',

        ];
    }
}