@extends('admin.layout')
@section('page_title', 'عرض كل تفاصيل اعدادات التطبيق')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الأعدادات</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.settings.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i>رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> عرض كل الأعدادات الخاصه بالتطبيق</h5>
                            <div class="container-fluid">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold"> # </div>
                                    <div class="col-lg-9 col-md-8">{{ $setting->id }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">اللوجو</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img id="image" src="{{ $setting->logo_url }}" alt="" height="100"
                                            width="150">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">العنوان الرئيسى</div>
                                    <div class="col-lg-9 col-md-8">{{ $setting->title }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">نبذه عن التطبيق</div>
                                    <div class="col-lg-9 col-md-8">{{ $setting->about_us }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">رقم الجوال</div>
                                    <div class="col-lg-9 col-md-8">{{ $setting->mobile ?? 'لا يوجد' }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">البريد الالكترونى</div>
                                    <div class="col-lg-9 col-md-8">{{ $setting->email }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ الانشاء</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $setting->created_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ التعديل</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $setting->updated_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}</div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
