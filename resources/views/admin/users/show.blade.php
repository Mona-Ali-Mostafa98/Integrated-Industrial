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
                            <div class="row pagetitle mb-2">

                                <div class="col-sm-6 d-flex justify-content-start">
                                    <h5 class="card-title fs-4">تفاصيل عن المستخدم :
                                        {{ $user->full_name }} </h5>
                                </div>

                                <div class="col-sm-6 d-flex justify-content-end">
                                    <div class="d-inline mt-3">
                                        @can('أضافة أعلان')
                                            <a href="{{ route('admin.user_add_ad_view', $user->id) }}"
                                                class="btn btn-lg btn-outline-success mb-2 "></i>
                                                أضافة أعلان</a>
                                        @endcan
                                    </div>
                                </div>

                            </div>
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
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">المدينه التابع لها
                                        المستخدم
                                    </div>
                                    <div class="col-lg-9 col-md-8"> {{ $user->city->city_name }} </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">العنوان بالتفصيل</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->address ?? 'لم يقم المستخدم بتحديد عنوانه بالتفصيل' }} </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الموقع الجغرافى للمستخدم
                                        على
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
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">نبذه تعريفيه عن المستخدم
                                    </div>
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

                                @can('أعلانات المستخدم')
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-4 label text-success fw-bold">أعلانات المستخدم
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <table class="table table-hover table-striped table-bordered border-dark"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">صور الأعلان</th>
                                                        <th scope="col">القسم التابع له الاعلان</th>
                                                        <th scope="col">تاريخ الأضافه</th>
                                                        <th scope="col">الأجراءت</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user_ads as $user_ad)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                @foreach ($user_ad->images as $ad_image)
                                                                    {{-- @if ($loop->first) --}}
                                                                    <img src="{{ asset('storage/ad_images/' . $ad_image->image) }}"
                                                                        alt="" height="60" width="60">
                                                                    {{-- @endif --}}
                                                                @endforeach
                                                            </td>
                                                            <td>{{ $user_ad->category->category_name }}</td>
                                                            <td>{{ $user_ad->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                @can('عرض أعلان')
                                                                    <a href="{{ route('admin.ads.show', $user_ad->id) }}"
                                                                        class=" btn btn-sm btn-success">عرض</a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-muted fs-4" colspan="6">لم يقم
                                                                المستخدم بأضافة أية أعلانات مسبقا....
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endcan


                                @can('الاعلانات المفضله للمستخدم')
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-4 label text-success fw-bold">الاعلانات المفضله للمستخدم
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <table class="table table-hover table-striped table-bordered border-dark"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">صورة الاعلان</th>
                                                        <th scope="col">القسم التابع له الاعلان</th>
                                                        <th scope="col">تاريخ الأعجاب</th>
                                                        <th scope="col">الأجراءت</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user_favorites as $user_favorite)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                @foreach ($user_favorite->ad->images as $ad_image)
                                                                    <img src="{{ asset('storage/ad_images/' . $ad_image->image) }}"
                                                                        alt="" height="60" width="60">
                                                                @endforeach
                                                            </td>
                                                            <td>{{ $user_favorite->ad->category->category_name }}</td>
                                                            <td>{{ $user_favorite->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                @can('عرض أعلان')
                                                                    <a href="{{ route('admin.ads.show', $user_favorite->ad_id) }}"
                                                                        class=" btn btn-sm btn-success">عرض</a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-muted fs-4" colspan="6">لم يقم
                                                                المستخدم بأضافة أية أعلانات الى المفضله مسبقا....
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endcan


                                @can('عرض شكاوى المستخدم')
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-4 label text-success fw-bold"> شكاوى المستخدم
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            <table class="table table-hover table-striped table-bordered border-dark"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">سبب الشكوى على الأعلان</th>
                                                        <th scope="col">القسم التابع له الأعلان</th>
                                                        <th scope="col">تاريخ أضافة التعليق</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user_complains as $user_complain)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $user_complain->status }}</td>
                                                            <td>{{ $user_complain->ad->category->category_name }}</td>

                                                            <td>{{ $user_complain->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-muted fs-4" colspan="6">لم يقم
                                                                المستخدم بتقديم أي شكوى بشأن الأعلانات مسبقا....
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endcan

                                @can('أسئلة المستخدم')
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-4 label text-success fw-bold">أسئلة المستخدم</div>
                                        <div class="col-lg-9 col-md-8">
                                            <table class="table table-hover table-striped table-bordered border-dark"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">سؤال المستخدم</th>
                                                        <th scope="col">تاريخ أرسال السؤال</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user_questions as $user_question)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $user_question->user_question }}</td>
                                                            <td>{{ $user_question->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-muted fs-4" colspan="6">لم يقم
                                                                المستخدم بأرسال اى أسئله مسبقا....
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endcan


                                @can('ردود المستخدم على اسئله')
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-4 label text-success fw-bold">ردود المستخدم على أسئله</div>
                                        <div class="col-lg-9 col-md-8">
                                            <table class="table table-hover table-striped table-bordered border-dark"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">سؤال المستخدم</th>
                                                        <th scope="col">تاريخ الأجابه على السؤال</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user_replies as $user_reply)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $user_reply->user_reply }}</td>
                                                            <td>{{ $user_reply->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-muted fs-4" colspan="6">لم يقم
                                                                المستخدم بالرد على اية أسئلة مسبقا....
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endcan


                                @can('تعليقات المستخدم')
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-4 label text-success fw-bold">تعليقات المستخدم على
                                            الأعلانات</div>
                                        <div class="col-lg-9 col-md-8">
                                            <table class="table table-hover table-striped table-bordered border-dark"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">تعليق المستخدم</th>
                                                        <th scope="col">القسم التابع له الاعلان</th>
                                                        <th scope="col">تاريخ أضافة التعليق</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($user_comments as $user_comment)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $user_comment->comment }}</td>
                                                            <td>{{ $user_comment->ad->category->category_name }}</td>

                                                            <td>{{ $user_comment->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center text-muted fs-4" colspan="6">لم يقم
                                                                المستخدم بأضافة أية تعليقات على أعلانات مسبقا....
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endcan


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
