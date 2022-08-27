<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModelRequest extends FormRequest
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
            'year' => ['required','integer','digits:4', Rule::unique('ad_models')->ignore($this->model)]
        ];
    }

    public function messages()
    {
        return[
            'year.required' => 'مطلوب ادخال سنه للموديل',
            'year.integer' => 'مطلوب ادخال سنة الموديل مكون من أرقام فقط',
            'year.digits' => 'مطلوب ادخال سنة موديل صحيحه ! أدخل السنه مكونه من 4 ارقام',
            'year.unique' => 'لقد تم اضافة سنة الموديل هذه من قبل ! برجاء اضافة سنه اخرى',

        ];
    }
}