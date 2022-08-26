@extends('admin.layout')
@section('page_title', 'عرض دوله')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الدول</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.countries.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">عرض كل التفاصيل عن دوله : {{ $country->country_name }}</h5>
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">#</div>
                                    <div class="col-lg-9 col-md-8">{{ $country->id }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">العنوان</div>
                                    <div class="col-lg-9 col-md-8">{{ $country->country_name }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الوصف</div>
                                    <div class="col-lg-9 col-md-8">{{ $country->country_code }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ الانشاء</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $country->created_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ التعديل</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $country->updated_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
