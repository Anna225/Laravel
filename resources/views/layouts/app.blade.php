<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Securtac</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonticon.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
    <!-- Sweet alert -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }} "> --}}
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset(getMetaValue('site_favicon')) }}">
    @if ( getMetaValue('google_tag_id') )
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ getMetaValue('google_tag_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ getMetaValue("google_tag_id") }}');
        </script>
    @endif

    @yield('header_scripts')
</head>

<body class="">
    <!--[if IE]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('js/jquery.min.js') }} "></script>
    <script src="{{ asset('js/scrollreveal.js') }} "></script>
    <script src="{{ asset('js/smoothscroll.js') }} "></script>
    <script src="{{ asset('js/bootstrap.min.js') }} "></script>
    {{-- <script src="https://kit.fontawesome.com/4e6c1348a1.js" crossorigin="anonymous"></script> --}}
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('plugins/sticky-notification-banner/src/jquery.notificationbanner.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }} "></script>
    <!--Start of Tawk.to Script-->
    @if ( Auth::guard()->check() )
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5e5ecfbfc32b5c1917396370/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    @endif

    @yield('footer_scripts')
    {{-- <div class="loader"><!-- Place at bottom of page --></div> --}}
</body>
</html>