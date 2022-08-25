<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class ParentCategoryRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        // this rule to prevent user enter any category id invalid in update from console like id of current category and his children
        // store id of all category in variable $id and pass it to rule to check if it possible to
        // use or not and if not possible return the message send in function messages
        $this->id = $category->id ;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)  //closure fun take attribute => parent_id  $value => 1,2,3,4, ...
    {
        $id = $this->id;

        if (!$id) {
            return true;
        }

        $categories = Category::where('id', '<>', $id)
            ->where(function($query) use($id) {
                $query->where('parent_id', '<>', $id)
                    ->orWhereNull('parent_id');
            })
            ->pluck('id')->toArray();

            if (!in_array($value, $categories)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'أنت تحاول ادخال قسم رئيسى غير مسموح بأختياره ليكون هذا القسم فرع منه ! برجاء أختيار قسم أخر';
    }
}
