@extends('admin.layout')
@section('page_title', 'Roles List')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الصلاحيات</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة صلاحيه')
                    <a href="{{ route('admin.roles.create') }}" class=" btn btn-success mb-2 ">
                        <i class="bi bi-plus-lg ms-1"></i> أضافة صلاحيه </a>
                @endcan
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> قائمة الصلاحيات</h5>

                            {{-- @include('admin.alerts') --}}

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">أسم الصلاحيه</th>
                                        {{-- <th scope="col">حالة العرض</th> --}}
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الأجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-success fw-bold">{{ $role->name }}</td>
                                            {{-- <td>{{ $role->status }}</td> --}}
                                            <td>{{ $role->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض صلاحيه')
                                                        <a href="{{ route('admin.roles.show', $role->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل صلاحيه')
                                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف صلاحيه')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.roles.destroy', $role->id) }}">
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
                            <!-- End Table with hoverable rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
