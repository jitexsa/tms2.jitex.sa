<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{ setCss(['fontawesome','vendors/slick', 'vendors/slick-theme', 'vendors/scrollbar',
'vendors/animate', 'datatable/responsive.bootstrap4.min', 'datatable/dataTables.bootstrap4.min',
 'vendors/select.bootstrap5', 'vendors/bootstrap', 'style', 'color-1', 
'responsive','select2/select2.min', 'daterangepicker/daterangepicker', 'flatpickr/flatpickr.min', 
'custom', 'api']) }}
        {{ setJs(['jquery.min', 'local-storage']) }}
        @livewireStyles
        @livewireScripts
        <script>
           let baseURL = '{{baseURL()}}';
        </script>
    </head>
    <body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <livewire:livewire.layout.header />
            <!-- Page Header Ends-->
            <!-- Page Body Start-->
            <div class="page-body-wrapper">
                <livewire:livewire.layout.navigation />
                <div class="page-body">
                <livewire:livewire.layout.breadcrumb />
                <livewire:livewire.layout.message />
                    <!-- Page Content -->
                    {{ $slot }}
                </div>
                <livewire:livewire.layout.footer />
            </div>
    </div>
    </body>
</html>
