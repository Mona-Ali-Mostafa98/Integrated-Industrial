@extends('admin.layout')
@section('page_title', 'أضافة مستخدم جديد')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">المستخدمين</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
                </h1>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> أضافة حساب </h5>
                            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                @csrf
                                @include('admin.users.form')


                                <div class="row mb-4">
                                    <label for="password" class="col-sm-2 col-form-label"> كلمة المرور </label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" id="password" placeholder="أدخل كلمة المرور"
                                            value="{{ old('password', $user->password) }}"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">حفظ</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
@include('admin.script_of_get_city_by_country')
