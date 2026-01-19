<style>
    #kt_app_sidebar {
        background-color: #06283d; /* Ganti dengan warna yang diinginkan */
    }
</style>
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="px-6 app-sidebar-logo" id="kt_app_sidebar_logo">
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup: ... -->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="rotate-180 ki-duotone ki-double-left fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
        <img src="{{ asset('assets/img/sipd.png') }} " style="height:43px; 
        margin-right: 70px; margin-left: 5px;" loading="lazy" decoding="async">
    </div> 
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="overflow-hidden app-sidebar-menu flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="my-5 app-sidebar-wrapper hover-scroll-overlay-y"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="px-3 menu menu-column menu-rounded menu-sub-indention" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <!-- Dashboard link removed -->
                <!--end:Menu item-->
                <!--begin:Menu item-->

                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="<?php echo e(route('dashboard')); ?>">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-address-book fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="{{ route('user.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-people fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">User</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="pt-5 menu-item">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Menu</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="<?php echo e(route('akreditas.index')); ?>">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-address-book fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                        <span class="menu-title">Akreditasi</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="<?php echo e(route('mahasiswa.index')); ?>">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-people fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Mahasiswa</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="<?php echo e(route('pegawai.index')); ?>">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-people fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Pegawai</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="<?php echo e(route('alumni.index')); ?>">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-people fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Alumni</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link" href="<?php echo e(route('pmb.index')); ?>">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-people fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Penerimaan Mahasiswa Baru</span>
                    </a>
                    <!--end:Menu link-->
                </div>

                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
