@extends('admin.layout')
@section('page_title', 'عرض تفاصيل عن مستخدم')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">المستخدمين</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">تفاصيل عن المستخدم : {{ $user->first_name }}
                                {{ $user->last_name }} </h5>
                            <div class="container-fluid">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">#</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->id }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">صورة المستخدم</div>

                                    @if ($user->profile_image)
                                        <div class="col-lg-9 col-md-8">
                                            <img id="image" src="{{ asset('storage/' . $user->profile_image) }}"
                                                alt="" height="100" width="150">
                                        </div>
                                    @else
                                        المستخدم ليس له صورة غلاف
                                    @endif
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الأسم الأول</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->first_name }}</div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الأسم الأخير</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->last_name }}</div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">رقم الجوال</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->mobile }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">البريد الالكترونى </div>
                                    <div class="col-lg-9 col-md-8"> {{ $user->email }} </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الدوله التابع لها المستخدم
                                    </div>
                                    <div class="col-lg-9 col-md-8"> {{ $user->country->country_name }} </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">المدينه التابع لها المستخدم
                                    </div>
                                    <div class="col-lg-9 col-md-8"> {{ $user->city->city_name }} </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">العنوان بالتفصيل</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->address ?? 'لم يقم المستخدم بتحديد عنوانه بالتفصيل' }} </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الموقع الجغرافى للمستخدم على
                                        الخريطه</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if ($user->address_on_map)
                                            <a href="{{ $user->address_on_map }}" class="text-primary" target="blank">رابط
                                                الموقع الجغرافى</a>
                                        @else
                                            لم يقم المستخدم بأضفة موقعه الجغرافى
                                        @endif

                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">نبذه تعريفيه عن المستخدم</div>
                                    <div class="col-lg-9 col-md-8"> {{ $user->details ?? 'لم يقم المستخدم بوصف نفسه' }}
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">حالة المستخدم </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->status }}
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ الانشاء</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->created_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ التعديل </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->updated_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
