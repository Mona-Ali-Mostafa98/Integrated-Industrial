@extends('admin.layout')
@section('page_title', 'لأقسام')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">أقسام المركز</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                @can('أضافة قسم')
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-2">
                        <i class="bi bi-plus-lg ms-1"></i> أضافة قسم </a>
                @endcan
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3"> أقسام المركز </h5>

                            {{-- @include('admin.alerts') --}}

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col">ID</th> --}}
                                        <th scope="col">الصوره</th>
                                        <th scope="col">العنوان</th>
                                        <th scope="col">القسم التابع له</th>
                                        <th scope="col">الحاله</th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الأجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $category->id }}</td> --}}
                                            <td><img src="{{ $category->category_image_url }}" alt="" height="60"
                                                    width="60"></td>
                                            <td class="text-success fw-bold">{{ $category->category_name }}</td>
                                            <td> {{ $category->parent->category_name ?? 'قسم رئيسى' }}</td>
                                            <td>{{ $category->status }}</td>
                                            <td>{{ $category->created_at?->translatedFormat('l , j F Y') ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    @can('عرض قسم')
                                                        <a href="{{ route('admin.categories.show', $category->id) }}"
                                                            class=" btn btn-sm btn-success">عرض</a>
                                                    @endcan
                                                    @can('تعديل قسم')
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                            class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                    @endcan
                                                    @can('حذف قسم')
                                                        <form class=" me-2 form-inline" method="post"
                                                            action="{{ route('admin.categories.destroy', $category->id) }}">
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
