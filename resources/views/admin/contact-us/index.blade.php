@extends('admin.layout')
@section('page_title', 'تواصل معنا')
@section('content')
    <main id="main" class="main">
        <div class="row pagetitle mb-2">
            <div class="col-sm-6 d-flex justify-content-start">
                <h1 class="mb-2 fs-2">تواصل معنا</h1>
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-4 mb-3">كل طلبات التواصل القادمه من المستخدمين</h5>

                            <table class="table table-hover table-striped table-bordered border-dark" style="width: 100%">

                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">رقم الجوال</th>
                                        <th scope="col">البريد الالكترونى</th>
                                        <th scope="col">تاريخ الانشاء</th>
                                        <th scope="col">الأجراءات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-success fw-bold">{{ $contact->name }}</td>
                                            <td>{{ $contact->mobile }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->created_at->diffForHumans(now()) }}</td>
                                            <td class="d-flex justify-content-start">
                                                @can('عرض تواصل معنا')
                                                    <a href="{{ route('admin.contact.show', $contact->id) }}"
                                                        class=" btn btn-sm btn-success">عرض</a>
                                                @endcan
                                                @can('حذف تواصل معنا')
                                                    <form class=" me-2 form-inline" method="post"
                                                        action="{{ route('admin.contact.destroy', $contact->id) }}">
                                                        @csrf
                                                        @method ('delete')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger show_confirm">حذف</button>
                                                    </form>
                                                @endcan

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
