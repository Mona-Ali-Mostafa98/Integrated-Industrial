    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            @can('الصفحه الرئيسيه')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/dashboard') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="p-2">الصفحه الرئيسيه</span>
                    </a>
                </li>
            @endcan



            @can('الاعدادات')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/settings*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.settings.index') }}">
                        <i class="bi bi-gear"></i>
                        <span class="p-2">الاعدادات</span>
                    </a>
                </li>
            @endcan



            @can('قائمة السليدرز')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/sliders*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.sliders.index') }}">
                        <i class="bi bi-images"></i>
                        <span class="p-2">السليدرز</span>
                    </a>
                </li>
            @endcan



            @can('قائمة الاقسام')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/categories*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-grid"></i>
                        <span class="p-2">الاقسام</span>
                    </a>
                </li>
            @endcan



            @can('قائمة الاعلانات')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/ads*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.ads.index') }}">
                        <i class="bi bi-badge-ad-fill"></i>
                        <span class="p-2">الاعلانات</span>
                    </a>
                </li>
            @endcan



            @can('قائمة الدول')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/countries*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.countries.index') }}">
                        <i class="bi bi-flag-fill"></i>
                        <span class="p-2">الدول</span>
                    </a>
                </li>
            @endcan



            @can('قائمة المدن')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/cities*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.cities.index') }}">
                        <i class="bi bi-map-fill"></i>
                        <span class="p-2">المدن</span>
                    </a>
                </li>
            @endcan



            @can('قائمة المناطق')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/regions*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.regions.index') }}">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span class="p-2">المناطق</span>
                    </a>
                </li>
            @endcan



            @can('قائمة المشرفين')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/admins*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.admins.index') }}">
                        <i class="bi bi-person-check"></i>
                        <span class="p-2">المشرفون</span>
                    </a>
                </li>
            @endcan



            @can('قائمة الصلاحيات')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/roles*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.roles.index') }}">
                        <i class="bi bi-key-fill"></i>
                        <span class="p-2">الصلاحيات</span>
                    </a>
                </li>
            @endcan



            @can('قائمة المستخدمين')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/users*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.users.index') }}">
                        <i class="bi bi-person-lines-fill"></i>
                        <span class="p-2">المستخدمين</span>
                    </a>
                </li>
            @endcan



            @can('قائمة الموديلات')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/models*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.models.index') }}">
                        <i class="bi bi-calendar3"></i>
                        <span class="p-2"> الموديلات</span>
                    </a>
                </li>
            @endcan



            @can('قائمة تواصل معنا')
                <li class="nav-item">
                    <a class="{{ Request::is('admin/contact*') ? 'nav-link fs-6' : 'nav-link collapsed fs-6' }} "
                        href="{{ route('admin.contact.index') }}">
                        <i class="bi bi-chat-square-text"></i>
                        <span class="p-2"> تواصل معنا</span>
                    </a>
                </li>
            @endcan

        </ul>

    </aside><!-- End Sidebar-->
