@extends('admin.layout')
@section('page_title', 'أعدادات الموقع ')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">الأعدادات </h1>
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">أعدادات الموقع</h5>

                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">اللوجو</th>
                                        <th scope="col">العنوان</th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">تاريخ التعديل</th>
                                        <th scope="col">الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $setting->id }}</td>
                                        <td><img src="{{ $setting->logo_url }}" style="height: 100px; width: 150px;"
                                                alt=""></td>
                                        <td>{{ $setting->title }}</td>
                                        <td>{{ $setting->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}</td>
                                        <td>{{ $setting->updated_at?->translatedFormat('l , j F Y') ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                @can('عرض الاعدادات')
                                                    <a href="{{ route('admin.settings.show', $setting->id) }}"
                                                        class="btn btn-sm btn-success">View</a>
                                                @endcan
                                                @can('تعديل الاعدادات')
                                                    <a href="{{ route('admin.settings.edit', $setting->id) }}"
                                                        class="me-2  btn btn-sm btn-primary">Edit</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
