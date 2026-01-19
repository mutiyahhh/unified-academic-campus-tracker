<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIPD - @yield('title')</title>
    @include('includes.style')
    @stack('addon-style')
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('partials.header')
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('partials.sidebar')
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="py-3 app-toolbar py-lg-6 ">
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack ">
                                <div class="flex-wrap page-title d-flex flex-column justify-content-center me-3 ">
                                    <h1 class="my-0 text-gray-900 page-heading d-flex fw-bold fs-3 flex-column justify-content-center">
                                        @yield('page-title')
                                    </h1>
                                    <ul class="pt-1 my-0 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
                                        <li class="breadcrumb-item text-muted">
                                            <a href="{{ route('dashboard') }}"
                                                class="text-muted text-hover-primary">
                                                HALAMAN </a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <span class="bg-gray-500 bullet w-5px h-2px"></span>
                                        </li>
                                        <li class="breadcrumb-item text-muted">@yield('breadcrumb')</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl ">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    @include('partials.footer')
                </div>
            </div>
        </div>
    </div>


    @include('includes.script')
    @stack('addon-script')
</body>

</html>
