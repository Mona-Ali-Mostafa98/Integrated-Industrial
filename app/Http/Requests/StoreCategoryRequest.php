<?php

namespace App\Http\Requests;

use App\Rules\ParentCategoryRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
        $id = $this -> route ('category'); // Gets the ID currently excluded, where category is a parameter in route {}
        return [
            'category_name' =>['required','string','max:255' , Rule::unique('categories')->ignore($this->category)],
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => ['nullable','exists:categories,id'],
            'category_order'=>['nullable' ,  Rule::in(['main_category', 'sub_category' ,'third_category'])],
            'status'=>['required' ,  Rule::in(['عرض', 'أخفاء'])]
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'مطلوب ادخال أسم القسم ',
            'category_name.string' => 'مطلوب ادخال أسم القسم مكون من حروف فقط',
            'category_name.max' => 'مطلوب ادخال أسم القسم لايزيد عن 255 حرفا',
            'category_name.unique' => 'تم اضافة قسم بهذا الاسم من قبل برجاء أدخال أسم أخر ',

            'category_image.required' => 'مطلوب رفع صوره',
            'category_image.image' => 'تاكد من انك قمت بادخال مسار صوره صحيح',
            'category_image.mimes' => 'فقط jpeg,png,jpg,gif,svg مطلوب رفع صوره من نوع',
            'category_image.max' => 'مطلوب رفع صوره لايزيد حجمها عن 2048 حرفا',

            'parent_id.exists' => 'لابد من اضافة القسم الرئيسى اولا قبل اضافة قسم فرعى منه',

            'category_order.in' => 'هناك خطأ فى ترتيب القسم يرجى ادخال أختيار ترتيب صحيح للقسم',

            'status.required' => 'مطلوب ادخال حالة العرض',
            'status.in' => 'هناك خطأ فى حالة العرض يرجى ادخال حالة عرض صحيح',
        ];
    }
}