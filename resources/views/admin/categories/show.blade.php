@extends('admin.layout')
@section('page_title', 'Show category')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">أقسام المركز</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-success mb-2"><i
                        class="bi bi-caret-left-fill ms-1"></i> رجوع</a>
            </div>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">تفاصيل عن قسم "{{ $category->category_name }}" </h5>
                            <div class="container-fluid">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">#</div>
                                    <div class="col-lg-9 col-md-8">{{ $category->id }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الصور</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img id="image" src="{{ asset('storage/' . $category->category_image) }}"
                                            alt="" height="100" width="150">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">العنوان</div>
                                    <div class="col-lg-9 col-md-8">{{ $category->category_name }}</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">القسم التابع له هذا القسم
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{-- to show parent category name insteadof show his id so return array in show fun --}}
                                        {{ $category->parent->category_name ?? 'هذا القسم قسم رئيسى' }}
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">ترتيب القسم أذا كان قسم فرعى
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $category->category_order }}
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الحاله </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $category->status }}
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ الانشاء</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $category->created_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">تاريخ التعديل </div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $category->updated_at?->translatedFormat('l , j F Y , H:i:s') ?? 'N/A' }}
                                    </div>
                                </div>



                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label text-success fw-bold">الاقسام التابعين لهذا القسم
                                    </div>

                                    <div class="col-lg-9 col-md-8">

                                        <table class="table table-hover table-striped" style="width: 100%">

                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">أسم القسم</th>
                                                    <th scope="col">ترتيب القسم</th>
                                                    <th scope="col">الحاله</th>
                                                    <th scope="col">تاريخ الأنشاء</th>
                                                    <th scope="col">الأجراءات</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($category->children as $child)
                                                    <tr>
                                                        <td>{{ $child->id }}</td>
                                                        <td>
                                                            <a class="text-success fw-bold" data-bs-toggle="tooltip"
                                                                data-bs-title="عرض معلومات عن القسم"
                                                                href="{{ route('admin.categories.show', $child->id) }}">{{ $child->category_name }}</a>

                                                        </td>
                                                        <td>{{ $child->category_order }}</td>
                                                        <td>{{ $child->status }}</td>
                                                        <td>{{ $child->created_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                @can('تعديل قسم')
                                                                    <a href="{{ route('admin.categories.edit', $child->id) }}"
                                                                        class=" me-2 btn btn-sm btn-primary">تعديل</a>
                                                                @endcan
                                                                @can('حذف قسم')
                                                                    <form class=" me-2 form-inline" method="post"
                                                                        action="{{ route('admin.categories.destroy', $child->id) }}">
                                                                        @csrf
                                                                        @method ('delete')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-danger show_confirm">حذف</button>
                                                                    </form>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center text-muted fs-4" colspan="5"></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>

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
