@extends('admin.layout')
@section('page_title', 'تحديث أعدادات التطبيق')
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
                            <h5 class="card-title fs-4 mb-3">التعديل على الأعدادات</h5>
                            <form method="POST" action="{{ route('admin.settings.update', $setting->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label">اللوجو</label>
                                    <div class="col-sm-10">
                                        <input name="logo" type="file"
                                            onchange="document.getElementById('logo').src = window.URL.createObjectURL(this.files[0])"
                                            class="form-control mb-3 @error('logo') is-invalid @enderror">
                                        @error('logo')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <img id="logo" src="{{ $setting->logo_url }}"
                                            style="height: 100px; width: 150px;" alt="لم يتم رفع لوجو مسبقا">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="title" class="col-sm-2 col-form-label">العنوان </label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" id="title" placeholder="ادخل عنوان للتطبيق"
                                            value="{{ old('title', $setting->title) }}"
                                            class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="about_us" class="col-sm-2 col-form-label">تعريف عن التطبيق</label>
                                    <div class="col-sm-10">
                                        <textarea name="about_us" id="about_us" rows="4" placeholder="ادخل نبذه تعريفيه للتطبيق"
                                            class="col-sm-12 form-control @error('about_us') is-invalid @enderror">{{ old('about_us', $setting->about_us) }}</textarea>
                                        @error('about_us')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <label for="mobile" class="col-sm-2 col-form-label">رقم الجوال </label>
                                    <div class="col-sm-10">
                                        <input name="mobile" type="text" id="mobile" placeholder="ادخل رقم الجوال"
                                            value="{{ old('mobile', $setting->mobile) }}"
                                            class="form-control @error('mobile') is-invalid @enderror">
                                        @error('mobile')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="email" class="col-sm-2 col-form-label">البريد الالكترونى </label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" id="email"
                                            placeholder="ادخل عنوان البريدالالكترونى"
                                            value="{{ old('email', $setting->email) }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="forbidden_ads" class="col-sm-2 col-form-label">الأعلانات الممنوعه</label>
                                    <div class="col-sm-10">
                                        <textarea name="forbidden_ads" id="forbidden_ads" rows="4"
                                            placeholder="حدد الاعلانات الممنوع مشاركتها  فى التطبيق"
                                            class="col-sm-12 form-control @error('forbidden_ads') is-invalid @enderror">{{ old('forbidden_ads', $setting->forbidden_ads) }}</textarea>
                                        @error('forbidden_ads')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
