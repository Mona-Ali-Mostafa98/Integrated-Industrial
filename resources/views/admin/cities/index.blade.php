@extends('admin.layout')
@section('page_title', 'قائمة المدن')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2"> المدن</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة مدينه')
                    <a href="{{ route('admin.cities.create') }}" class="btn btn-success mb-2 ">
                        <i class="bi bi-plus-lg"></i> أضافة مدينه </a>
                @endcan
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">قائمة المدن</h5>
                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">

                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">أسم المدينه</th>
                                        <th scope="col">الدوله التابعه لها </th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الاجراءت</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-success fw-bold">{{ $city->city_name }}</td>
                                            <td>{{ $city->country->country_name }}</td>
                                            <td>{{ $city->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض مدينه')
                                                        <a href="{{ route('admin.cities.show', $city->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل مدينه')
                                                        <a href="{{ route('admin.cities.edit', $city->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف مدينه')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.cities.destroy', $city->id) }}">
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
                                {{ $cities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
