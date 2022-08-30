@extends('admin.layout')
@section('page_title', 'قائمة الأعلانات')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2"> الأعلانات</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة أعلان')
                    <a href="{{ route('admin.ads.create') }}" class="btn btn-success mb-2 ">
                        <i class="bi bi-plus-lg"></i> أضافة أعلان </a>
                @endcan
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">قائمة الأعلانات</h5>
                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">

                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">صاحب الأعلان</th>
                                        <th scope="col">القسم التابع له الأعلان</th>
                                        <th scope="col">المدينه</th>
                                        <th scope="col">المنطقه</th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الاجراءت</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($ads as $ad)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-success fw-bold">
                                                <a href="{{ route('admin.users.show', $ad->user->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-title="عرض تفاصيل عن المستخدم">
                                                    {{ $ad->user->first_name }} {{ $ad->user->last_name }}</a>
                                            </td>
                                            <td>{{ $ad->category->category_name }}</td>
                                            <td>{{ $ad->city->city_name }}</td>
                                            <td>{{ $ad->region->region_name }}</td>

                                            <td>{{ $ad->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض أعلان')
                                                        <a href="{{ route('admin.ads.show', $ad->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل أعلان')
                                                        <a href="{{ route('admin.ads.edit', $ad->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف أعلان')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.ads.destroy', $ad->id) }}">
                                                            @csrf
                                                            @method ('delete')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger show_confirm">حذف</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <div class="mt-4 mb-3 d-flex justify-content-end">
                                {{ $ads->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
