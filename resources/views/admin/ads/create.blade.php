@extends('admin.layout')
@section('page_title', 'أضافة أعلان')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الأعلانات</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.ads.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> أضافة أعلان</h5>
                            <form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                                @csrf
                                @include('admin.ads.form')
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection


@include('admin.script_of_get_city_region_by_ajax')

@include('admin.script_of_get_subcategory_by_category')


@include('admin.ads.script_for_show_uploaded_images')
