<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/taxi.svg') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/toaster/toastr.min.css') }}">
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <style type="text/css">
        .table-striped tbody tr:nth-of-type(odd){
         background-color: #d1d1d1 !important;
        }
        .table-hover tbody tr:hover{
         background-color:#002033 !important;
         color: #ccc !important;
         cursor: pointer;
        }
        .thead-color{
         background-color: #002033 !important;
         color: white !important;
         font-weight: bold;
        }
    </style>
</head>
