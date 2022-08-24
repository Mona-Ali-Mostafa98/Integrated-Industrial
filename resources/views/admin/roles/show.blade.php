@extends('admin.layout')
@section('page_title', 'Show Role')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الصلاحيات</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-success mb-2 "><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">عرض تفاصيل عن صلاحيه "{{ $role->name }}" </h5>
                            <div class="container-fluid">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">#</div>
                                    <div class="col-lg-9 col-md-8">{{ $role->id }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الاسم</div>
                                    <div class="col-lg-9 col-md-8">{{ $role->name }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الصلاحيات</div>
                                    @if (!empty($rolePermissions))
                                        <div class="col-lg-9 col-md-8">
                                            @foreach ($rolePermissions as $role_permission)
                                                <div>{{ $role_permission->name }}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ الانشاء</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $role->created_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ التعديل </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $role->updated_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}
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
