<html>
<head>
    <title>BeastlyBot - App | @yield('title')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3f8ef7">
    <meta name="msapplication-TileColor" content="#3f8ef7">
    <meta name="theme-color" content="#ffffff">
    @yield('metadata')
    @include('partials/head')
    @yield('head')
</head>

<body class="animsition @auth @if(!auth()->user()->theme_color) dark @endif @endauth @guest dark @endguest @if(Request::path() == 'dashboard' || Request::path() == 'discord_oauth') page-aside-fixed page-aside-right @else app-beast @endif">

@include('partials/header')


<div class="page bg-grey-2">
    @yield('content')
    </div>
    @include('partials/modals')
</div>
@include('partials/footer')
@yield('help-button')
@include('partials/scripts')

<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function () {
        @if(Session::has('alert'))
        Toast.fire({
            type: '{{ Session::get('alert')['type'] }}',
            title: '{{ Session::get('alert')['msg'] }}'
        });

        {!! Session::forget('alert') !!}
        @endif
    });

</script>


<!---- SCRIPTS ----->
@yield('scripts')
</body>
</html>
