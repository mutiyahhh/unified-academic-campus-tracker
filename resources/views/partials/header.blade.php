<style>
    #kt_app_header {
        background-color: #06283d; /* Ganti dengan warna yang diinginkan */
    }

    /* Hamburger Menu - Fix positioning and smooth hover */
    #kt_app_sidebar_mobile_toggle {
        position: relative;
        z-index: 10;
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    #kt_app_sidebar_mobile_toggle:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    #kt_app_sidebar_mobile_toggle:active {
        transform: scale(0.95);
    }

    #kt_app_sidebar_mobile_toggle i {
        transition: all 0.3s ease;
        color: #ffffff;
    }

    #kt_app_sidebar_mobile_toggle:hover i {
        color: #e0f2fe;
        transform: rotate(90deg);
    }

    /* Ensure hamburger doesn't cover menu items */
    .d-flex.align-items-center.d-lg-none {
        position: relative;
        z-index: 100;
        margin-left: 0 !important;
        padding: 0.5rem;
    }

    /* Header menu items - ensure they're not covered */
    #kt_app_header_menu {
        position: relative;
        z-index: 1;
    }

    /* Smooth transitions for header menu items */
    .app-header-menu .menu-link {
        transition: all 0.2s ease;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
    }

    .app-header-menu .menu-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-1px);
    }

    /* Mobile responsive adjustments */
    @media (max-width: 991.98px) {
        #kt_app_sidebar_mobile_toggle {
            margin-right: 0.5rem;
        }

        /* Hide top navigation menu on mobile - sidebar is the only navigation */
        .app-header-menu,
        #kt_app_header_menu,
        #kt_app_header_menu_wrapper > .app-header-menu {
            display: none !important;
        }

        /* Hide header menu toggle button on mobile */
        #kt_app_header_menu_toggle {
            display: none !important;
        }

        /* Ensure header wrapper doesn't take unnecessary space on mobile */
        #kt_app_header_wrapper {
            justify-content: flex-end;
        }
    }

    /* Desktop: Show header menu */
    @media (min-width: 992px) {
        .app-header-menu {
            display: flex !important;
        }
    }
</style>
<div id="kt_app_header" class="app-header">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none" title="Show sidebar menu" style="padding: 0.5rem; position: relative; z-index: 100;">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('dashboard') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('assets/img/sipd.png') }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper - Hidden on mobile, visible on desktop -->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch d-none d-lg-flex" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: false, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="px-2 my-5 menu menu-rounded menu-column menu-lg-row my-lg-0 align-items-stretch fw-semibold px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div
                        class="menu-item me-0 me-lg-2 {{ request()->routeIs('dashboard') ? '  here show menu-here-bg' : '' }}">
                        <!--begin:Menu link-->
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <span class="menu-title">Dashboards</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @role(['admin', 'manajemen'])
                        <div
                            class="menu-item me-0 me-lg-2 {{ request()->routeIs('akreditas.index') ? '  here show menu-here-bg' : '' }}">
                            <!--begin:Menu link-->
                            <a href="{{ route('akreditas.index') }}" class="menu-link">
                                <span class="menu-title">Akreditas</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endrole
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div
                        class="menu-item me-0 me-lg-2 {{ request()->routeIs('mahasiswa.index') ? '  here show menu-here-bg' : '' }}">
                        <!--begin:Menu link-->
                        <a href="{{ route('mahasiswa.index') }}" class="menu-link">
                            <span class="menu-title">Mahasiswa</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div
                        class="menu-item me-0 me-lg-2 {{ request()->routeIs('pmb.index') ? '  here show menu-here-bg' : '' }}">
                        <!--begin:Menu link-->
                        <a href="{{ route('pmb.index') }}" class="menu-link">
                            <span class="menu-title">PMB</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div
                        class="menu-item me-0 me-lg-2 {{ request()->routeIs('alumni.index') ? '  here show menu-here-bg' : '' }}">
                        <!--begin:Menu link-->
                        <a href="{{ route('alumni.index') }}" class="menu-link">
                            <span class="menu-title">Alumni</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @role(['admin', 'manajemen'])
                        <div
                            class="menu-item me-0 me-lg-2 {{ request()->routeIs('pegawai.index') ? '  here show menu-here-bg' : '' }}">
                            <!--begin:Menu link-->
                            <a href="{{ route('pegawai.index') }}" class="menu-link">
                                <span class="menu-title">Pegawai</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div
                            class="menu-item me-0 me-lg-2 {{ request()->routeIs('user.index') ? '  here show menu-here-bg' : '' }}">
                            <!--begin:Menu link-->
                            <a href="{{ route('user.index') }}" class="menu-link">
                                <span class="menu-title">User</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    @endrole
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="flex-shrink-0 app-navbar">
                <div class="app-navbar-item ms-1 ms-md-4">
                    <!--begin::Menu- wrapper-->
                    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                        <i class="ki-duotone ki-notification-status fs-2"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                    </div>

                    <!--begin::Notification-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true"
                        id="kt_menu_notifications" style="">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top"
                            style="background-image:url('assets/media/misc/menu-header-bg.jpg')">
                            <!--begin::Title-->
                            <h3 class="mt-10 mb-6 text-white fw-semibold px-9">
                                Notifikasi
                            </h3>
                            <!--end::Title-->

                            <!--begin::Tabs-->
                            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="pb-4 text-white opacity-75 nav-link opacity-state-100 active"
                                        data-bs-toggle="tab" href="#kt_topbar_notifications_1" aria-selected="true"
                                        role="tab">Peringatan</a>
                                </li>
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Heading-->

                        @forelse ($akreditas as $akredita)
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab panel-->
                                <div class="tab-pane fade active show" id="kt_topbar_notifications_1" role="tabpanel">
                                    <!--begin::Items-->
                                    <div class="px-8 my-5 scroll-y mh-325px">
                                        <!--begin::Item-->
                                        <div class="py-4 d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-35px me-4">
                                                    <span class="symbol-label bg-light-danger">
                                                        <i class="ki-duotone ki-information-5 fs-2 text-danger ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->

                                                <!--begin::Title-->
                                                <div class="mb-0 me-2">
                                                    <a href="#"
                                                        class="text-gray-800 fs-6 text-hover-primary fw-bold">Akreditas
                                                        Hampir kadaluarsa</a>
                                                    <div class="text-gray-500 fs-7">{{ $akredita->name }}</div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Section-->

                                            <!--begin::Label-->
                                            <span class="badge badge-light fs-8">
                                                {{ \Carbon\Carbon::parse($akredita->expired)->diffForHumans(null, true) }}
                                            </span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->

                                    <!--begin::View more-->
                                    <div class="py-3 text-center border-top">

                                    </div>
                                    <!--end::View more-->
                                </div>
                            </div>
                        @empty
                        <div class="tab-content">
                            <!--begin::Tab panel-->
                            <div class="tab-pane fade active show" id="kt_topbar_notifications_1" role="tabpanel">
                                <!--begin::Items-->
                                <div class="px-8 my-5 scroll-y mh-325px">
                                    <!--begin::Item-->
                                    <div class="py-4 d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center">
                                            <h3>Tidak ada notifikasi</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <!--end::Menu--> <!--end::Menu wrapper-->
                </div>
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img src="assets/media/avatars/300-1.jpg" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="px-3 menu-item">
                            <div class="px-3 menu-content d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="assets/media/avatars/300-1.jpg" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}
                                    </div>
                                    <a href="#"
                                        class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="my-2 separator"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                       <!-- <div class="px-5 menu-item">  <a href="../../demo1/dist/account/overview.html" class="px-5 menu-link">My Profile</a> </div> -->
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="px-5 menu-item">
                            <a href="{{ route('logout') }}" class="px-5 menu-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::Header menu toggle - Hidden on mobile -->
                <div class="app-navbar-item d-none d-lg-flex ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                        id="kt_app_header_menu_toggle">
                        <i class="ki-duotone ki-element-4 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
