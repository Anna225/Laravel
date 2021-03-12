<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'SECURTAC')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2sweetalert2.min.css') }}"> --}}
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
    <!-- adminlte stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('admin-dist/css/adminlte.min.css') }}">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('admin-dist/css/style.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset(getMetaValue('site_favicon')) }}">

    @yield('header_scripts')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.partials.main-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('admin.partials.control-sidebar')

        <!-- Main Footer -->
        @include('admin.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{--     <!-- SweetAlert2 -->
    <script src="{{ URL::asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script> --}}
    <!-- Toastr -->
    <script src="{{ URL::asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('admin-dist/js/adminlte.min.js') }}"></script>

    @yield('footer_scripts')

</body>
</html>