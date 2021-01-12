<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

@if (Request::path() != '/subscribe')
<!--<meta name="description" content="The beastly subscription bot for communities.">-->
<meta name="author" content="beastlybot.com">
@endif
<!-- Stylesheets -->
<link rel="stylesheet" href="{{ asset('global/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/css/bootstrap-extend.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/site-base.css') }}">

<link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/vendor/slick-carousel/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom10.css') }}">
<link rel="stylesheet" href="{{ asset('global/vendor/intro-js/introjs.css') }}">
<!-- Fonts -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
<link rel="stylesheet" href="{{ asset('global/fonts/web-icons/web-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('global/fonts/beastly/style.css') }}">

<!--[if lt IE 9]>
<script src="{{ asset('global/vendor/html5shiv/html5shiv.min.js') }}"></script>
<![endif]-->

<!--[if lt IE 10]>
<script src="{{ asset('global/vendor/media-match/media.match.min.js') }}"></script>
<script src="{{ asset('global/vendor/respond/respond.min.js') }}"></script>
<![endif]-->

<!-- Scripts -->
<script src="{{ asset('global/vendor/breakpoints/breakpoints.js') }}"></script>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<link rel="stylesheet" href="{{ asset('sceditor/minified/themes/default.min.css') }}" />
<script>
    Breakpoints();
</script>


<style>
    .loading {
        background-color: #ffffff;
        background-image: url("{{ asset('Ripple-1s-200px.gif') }}");
        background-size: 25px 25px;
        background-position:right center;
        background-repeat: no-repeat;
    }
    .col-centered{
        float: none;
        margin: 0 auto;
    }
</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9E73PYLJCT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9E73PYLJCT');
</script>