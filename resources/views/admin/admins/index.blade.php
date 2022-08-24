@extends('admin.layout')
@section('page_title', 'Admins List')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">المشرفون</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة مشرف')
                    <a href="{{ route('admin.admins.create') }}" class=" btn btn-success mb-2 ">
                        <i class="bi bi-plus-lg ms-1"></i> أضافة مشرف </a>
                @endcan
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> قائمة المشرفين</h5>

                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">

                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الصوره</th>
                                        <th scope="col">العنوان</th>
                                        <th scope="col">الحاله</th>
                                        <th scope="col">الصلاحيات</th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الأجراءات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/' . $admin->image) }}" alt=""
                                                    height="60" width="60"></td>
                                            <td class="text-success fw-bold">{{ $admin->name }}</td>
                                            <td>{{ $admin->status }}</td>
                                            <td>
                                                @if ($admin->roles_name)
                                                    @foreach ($admin->roles_name as $key => $value)
                                                        <span class="badge bg-success fs-6"> {{ $value }}
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $admin->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض مشرف')
                                                        <a href="{{ route('admin.admins.show', $admin->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل مشرف')
                                                        <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف مشرف')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.admins.destroy', $admin->id) }}">
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

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
