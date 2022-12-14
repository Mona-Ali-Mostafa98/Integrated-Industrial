<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'الصفحه الرئيسيه',

            'الاعدادات',
            'عرض الاعدادات',
            'تعديل الاعدادات',

            'قائمة السليدرز',
            'أضافة سليدر',
            'عرض سليدر',
            'تعديل سليدر',
            'حذف سليدر',

            'قائمة الاقسام',
            'أضافة قسم',
            'عرض قسم',
            'تعديل قسم',
            'حذف قسم',

            'قائمة الاعلانات',
            'أضافة أعلان',
            'عرض أعلان',
            'تعديل أعلان',
            'حذف أعلان',

            'قائمة الموديلات',
            'أضافة موديل',
            'عرض موديل',
            'تعديل موديل',
            'حذف موديل',

            'قائمة الدول',
            'أضافة دوله',
            'عرض دوله',
            'تعديل دوله',
            'حذف دوله',

            'قائمة المدن',
            'أضافة مدينه',
            'عرض مدينه',
            'تعديل مدينه',
            'حذف مدينه',

            'قائمة المناطق',
            'أضافة منطقه',
            'عرض منطقه',
            'تعديل منطقه',
            'حذف منطقه',

            'قائمة المشرفين',
            'أضافة مشرف',
            'عرض مشرف',
            'تعديل مشرف',
            'حذف مشرف',

            'قائمة الصلاحيات',
            'أضافة صلاحيه',
            'عرض صلاحيه',
            'تعديل صلاحيه',
            'حذف صلاحيه',

            'قائمة المستخدمين',
            'أضافة مستخدم',
            'عرض مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'أعلانات المستخدم',

            'الاعلانات المفضله للمستخدم',

            'أشتراكات المستخدم',

            'تعليقات المستخدم',

            'أسئلة المستخدم',

            'ردود المستخدم على اسئله',

            'عرض شكاوى المستخدم',

            'عرض التقييم للأعلان',

            'عرض الشكاوى للأعلان',

            'قائمة تواصل معنا',
            'عرض تواصل معنا',
            'حذف تواصل معنا',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}