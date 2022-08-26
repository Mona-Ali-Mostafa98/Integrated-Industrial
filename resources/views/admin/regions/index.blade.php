@extends('admin.layout')
@section('page_title', 'قائمة المناطق')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2"> المناطق</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة منطقه')
                    <a href="{{ route('admin.regions.create') }}" class="btn btn-success mb-2 ">
                        <i class="bi bi-plus-lg"></i> أضافة منطقه </a>
                @endcan
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">قائمة المناطق</h5>
                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">

                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">أسم المنطقه</th>
                                        <th scope="col">الدوله التابعه لها </th>
                                        <th scope="col">المدينه التابعه لها </th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الاجراءت</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($regions as $region)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-success fw-bold">{{ $region->region_name }}</td>
                                            <td>{{ $region->country->country_name }}</td>
                                            <td>{{ $region->city->city_name }}</td>
                                            <td>{{ $region->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض سليدر')
                                                        <a href="{{ route('admin.regions.show', $region->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل سليدر')
                                                        <a href="{{ route('admin.regions.edit', $region->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف سليدر')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.regions.destroy', $region->id) }}">
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
                                {{ $regions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
