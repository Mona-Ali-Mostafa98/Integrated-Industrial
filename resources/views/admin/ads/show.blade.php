@extends('admin.layout')
@section('page_title', 'عرض أعلان')
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
                            <h5 class="card-title fs-4 mb-3">عرض كل التفاصيل عن الأعلان التابع لقسم :
                                {{ $ad->category->category_name }}
                            </h5>
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">#</div>
                                    <div class="col-lg-9 col-md-8">{{ $ad->id }}</div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">صور الأعلان</div>
                                    @foreach ($ad->images as $value)
                                        <img src="{{ $value->image_url }}" style="height: 100px; width: 150px;">
                                    @endforeach
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">صاحب الأعلان</div>
                                    <div class="col-lg-9 col-md-8">{{ $ad->user->full_name }}
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">القسم التابع له </div>
                                    <div class="col-lg-9 col-md-8">{{ $ad->category->category_name }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">القسم الفرعى التابع له</div>
                                    <div class="col-lg-9 col-md-8">{{ $ad->sub_category->category_name }}</div>
                                </div>


                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">المدينة</div>
                                    <div class="col-lg-9 col-md-8">{{ $ad->city->city_name }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">المنطقه</div>
                                    <div class="col-lg-9 col-md-8"> {{ $ad->region->region_name }} </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">موديل الاعلان</div>
                                    <div class="col-lg-9 col-md-8"> {{ $ad->model->year }} </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الموديل</div>
                                    <div class="col-lg-9 col-md-8"> {{ $ad->model->year }} </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">السعر</div>
                                    <div class="col-lg-9 col-md-8"> {{ $ad->price }} </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">وصف الأعلان</div>
                                    <div class="col-lg-9 col-md-8"> {{ $ad->description }} </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">أخفاء رقم الهاتف</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if ($ad->hide_mobile == 1)
                                            نعم
                                        @else
                                            لا
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ الانشاء</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $ad->created_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ التعديل</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $ad->updated_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
