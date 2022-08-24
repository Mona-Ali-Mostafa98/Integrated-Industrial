@extends('admin.layout')
@section('page_title', 'تعديل صلاحيه')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الصلاحيات</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">تعديل صلاحيه</h5>
                            <form method="POST" action="{{ route('admin.roles.update', $role->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('admin.roles.form')
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
