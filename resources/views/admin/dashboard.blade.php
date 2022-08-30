@extends('admin.layout')
@section('page_title', 'الصناعيه المتكامله')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>الصفحه الرئيسيه</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Admins Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card admins-card">
                                <div class="card-body">
                                    <h5 class="card-title">المشرفون</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-check"></i>
                                        </div>
                                        <div class="pe-3">
                                            <h6>{{ $admins_count }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Admins Card -->

                        <!-- Users Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card users-card">
                                <div class="card-body">
                                    <h5 class="card-title">المستخدمين</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="pe-3">
                                            <h6>{{ $users_count }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Users Card -->

                        <!-- Kids Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card kids-card">
                                <div class="card-body">
                                    <h5 class="card-title">الأقسام</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-grid"></i>
                                        </div>
                                        <div class="pe-3">
                                            <h6>{{ $categories_count }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Kids Card -->


                        <!-- Contact us Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card contacts-card">
                                <div class="card-body">
                                    <h5 class="card-title">الأعلانات</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-badge-ad"></i>
                                        </div>
                                        <div class="pe-3">
                                            <h6>{{ $ads_count }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Contact us Card -->

                        <!-- Admins last registers -->
                        <div class="col-12">
                            <div class="card list-admins overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">المشرفون الذين تمت أضافتهم مؤخرا</h5>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">الصوره</th>
                                                <th scope="col">الأسم</th>
                                                <th scope="col">البريد الألكترونى</th>
                                                <th scope="col">تاريخ الاضافه</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <th scope="row"><img src="{{ asset('storage/' . $admin->image) }}"
                                                            alt=""></th>
                                                    <td><a href="#"
                                                            class="text-primary fw-bold">{{ $admin->name }}</a></td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td class="fw-bold">{{ $admin->created_at->diffForHumans(now()) }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Admins last registers -->

                    </div>
                </div><!-- End Left side columns -->


            </div>
        </section>

    </main>

@endsection
