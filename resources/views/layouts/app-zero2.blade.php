<html>
    <head>
        @if(!str_contains(url()->current(), 'shop/'))<title>@yield('title') | BeastlyBot</title>@endif
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3f8ef7">
        <meta name="msapplication-TileColor" content="#3f8ef7">
        <meta name="theme-color" content="#ffffff">
        @yield('metadata')
        @include('partials/head')
    </head>

    <body class="animsition page-locked layout-zero dark layout-dark">

        <div class="page">
            @yield('content')
            @include('partials/modals')
        </div>
        @include('partials/footer')
        @yield('help-button')
        @include('partials/scripts')

        @yield('scripts')

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
    </body>
</html>
