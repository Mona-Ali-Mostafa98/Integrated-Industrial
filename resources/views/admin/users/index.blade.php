@extends('admin.layout')
@section('page_title', 'قائمة المستخدمين')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">المستخدمين</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة مستخدم')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-2">
                        <i class="bi bi-plus-lg ms-1"></i> أنشاء حساب </a>
                @endcan
                </h1>
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> المستخدمين </h5>


                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الأسم</th>
                                        <th scope="col">رقم الهاتف</th>
                                        <th scope="col">البريد الالكترونى</th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الأجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-success fw-bold">{{ $user->first_name }} {{ $user->last_name }}
                                            </td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض مستخدم')
                                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل مستخدم')
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف مستخدم')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.users.destroy', $user->id) }}">
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
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
