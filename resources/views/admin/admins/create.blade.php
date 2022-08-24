@extends('admin.layout')
@section('page_title', 'Create New Admin')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">المشرفون</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.admins.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">أضافة مشرف</h5>
                            <form method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data">
                                @csrf
                                @include('admin.admins.form')

                                <div class="row mb-4">
                                    <label for="email" class="col-sm-2 col-form-label">كلمة المرور </label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control" id="password-field"
                                            value="{{ old('password') }}">

                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
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
