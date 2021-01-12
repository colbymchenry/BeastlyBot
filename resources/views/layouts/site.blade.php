<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('metadata')
    <title>BeastlyBot @if (Request::path() != '/')- @yield('title')@endif</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3f8ef7">
    <meta name="msapplication-TileColor" content="#3f8ef7">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-title" content="BeastlyBot">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_1136x640.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
      href="/assets/splash/icon_2436x1125.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_1792x828.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_828x1792.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_1334x750.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
      href="/assets/splash/icon_1242x2688.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
      href="/splashscreens/LaunchImage-1242@3x~iphone6s-landscape_2208x1242"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
      href="/assets/splash/icon_1125x2436.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
      href="/splashscreens/LaunchImage-1242@3x~iphone6s-portrait_1242x2208.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_2732x2048.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
      href="/assets/splash/icon_2688x1242.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_2224x1668.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_750x1334.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_2048x2732.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_2388x1668.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_1668x2224.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_640x1136.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_1668x2388.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
      href="/assets/splash/icon_2048x1536.png"
    />
    <link
      rel="apple-touch-startup-image"
      media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
      href="/assets/splash/icon_1536x2048.png"
    />

    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.min.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('site/assets/css/font-awesome.min.css') }}">
    <script src="https://kit.fontawesome.com/0d6c8e3ab8.js"></script>-->
    <link rel="stylesheet" href="{{ asset('global/fonts/beastly/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/elegant.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/mmenu/dist/mmenu.css') }}"/>
    <link rel="stylesheet" href="{{ asset('site/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/slick-t.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive.css') }}">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href="{{ asset('sceditor/minified/themes/default.min.css') }}"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9E73PYLJCT"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-9E73PYLJCT');
    </script>
</head>

<body class="bg-grey-1">
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!--header-starts-->
<header class="header-area style-2">
    <div id="sticker" class="header-bottom">
        <div class="container-fluid">
            <div class="row height-100 align-items-center">
                <div class="col-lg-4 col-md-6 col-9">
                    <div class="logo style-2">
                        <a href="https://beastlybot.com" class="logo-black logo-top"><img
                                src="{{asset('site/assets/images/beastlybot-logo4-w.png')}}" height="40" alt="logo"/>
                            <!--<h3 class="logo-top">Discord Beast</h3>--></a>
                        <a href="https://beastlybot.com" class="logo-white logo-top"><img
                                src="{{asset('site/assets/images/beastlybot-logo4-w.png')}}" height="40" alt="logo"/>
                            <!--<h3 class="logo-top">Discord Beast</h3>--></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-3">
                    <div class="d-flex header-right pull-right">
                        <div class="mainmenu style-2">
                            <nav>
                                <ul class="list-none">
                                    <li><a href="https://beastlybot.com/">Home</a>
                                    </li>
                                    <li><a href="https://beastlybot.com/faq">FAQs</a>
                                    </li>
                                    <li><a href="https://beastlybot.com/about">About</a>
                                    </li>
                                    {{-- <li><a href="https://beastlybot.com/blog">Blog</a>
                                    </li> --}}
                                    <li><a href="https://beastlybot.com/status">Status</a>
                                    </li>
                                    {{-- <li><a href="#" onclick="return false;">Help</a>
                                        <ul class="submenu">
                                            <li><a href="/faq">FAQs</a></li>
                                            <li><a href="/help">Support</a></li>
                                        </ul>
                                    </li>--}} <!--
											<li class="mobile-icon">
												<a href="#mobile-menu"><i class="ti-menu"></i></a>
											</li>-->
                                </ul>
                            </nav>
                        </div>
                        <!-- <button type="button" class="btn radius-50 help-line style-2" onclick="window.location.href = 'https\:\/\/discord.beastlybot.com\/dashboard' ">
                            {{--@auth--}}
                            <a href="https://discord.beastlybot.com/dashboard">
                                <i class="icon-discord"></i>
                                Dash<span class="ds-sm-none">board</span></a>
                            {{--@else
                                <a href="{{ env('DISCORD_OAUTH_URL') }}">
                                <i class="icon-discord"></i> Login<span
                                        class="ds-sm-none"> with Discord</span></a>
                            @endauth--}}
                        </button> -->
                        <!--<div class="site-lang in-right">
                            <ul>
                                <li>
                                    <img src="site/assets/images/flags/uk.jpg" alt="" />
                                    <a href="#">EN</a>
                                    <ul>
                                        <li><img src="site/assets/images/flags/fr.jpg" alt="" /><a href="#">French</a></li>
                                        <li><img src="site/assets/images/flags/uk.jpg" alt="" /><a href="#">English</a></li>
                                        <li><img src="site/assets/images/flags/gr.jpg" alt="" /><a href="#">German</a></li>
                                        <li><img src="site/assets/images/flags/vn.jpg" alt="" /><a href="#">Vietnam</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                    <div class="d-hidden mobile-menu">
                        <nav id="mobile-menu">
                            <div id="panel-menu">
                                <ul class="list-none">
                                    <li><a href="/">Home</a>
                                    </li>
                                    <li><a href="/faq">FAQs</a>
                                    </li>
                                    <li><a href="/about">About</a>
                                    </li>
                                    {{--<li><a href="/blog">Blog</a>
                                    </li>--}}
                                    <li><a href="#">Help</a>
                                        <ul>
                                            <li><a href="/faq">FAQs</a></li>
                                            <li><a href="/help">Support</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!--<div id="panel-lang">
                                <ul>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Vietnam</a></li>
                                </ul>
                            </div>-->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header-ends-->

@yield('content')



<!--footer starts-->
<footer class="footer-area bg-grey-2">
    <div class="container">
        <div class="row footer-top pt-60 pb-55">
            <div class="col-lg-4 col-sm-6">
                <div class="footer-widget pl-65">
                    <div class="footer-widget-title">
                        <h4><span>About Us</span></h4>
                    </div>
                    <ul class="list-none">
                        <li><a href="https://beastlybot.com/about">About Us</a></li>
                        <li><a href="https://beastlybot.com/status">Status</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="footer-widget mt-sm-35">
                    <div class="footer-widget-title">
                        <h4><span>Help</span></h4>
                    </div>
                    <ul class="list-none">
                        <li><a href="https://beastlybot.com/faq">Frequently Asked Questions</a></li>
                        <li><a href="https://discord.beastlybot.com/dashboard">Help Tutorials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="footer-widget footer-contact mt-sm-35">
                    <div class="footer-widget-title">
                        <h4><span>Contact Us</span></h4>
                    </div>
                    <ul class="list-none">
                        <li>team@beastly.app</li>
                    </ul>
                    {{--<div class="social-icons style-2 mt-10">
                        <a href="#"><i class="icon-facebook"></i></a>
                        <a href="#"><i class="icon-twitter"></i></a>
                        <a href="#"><i class="icon-discord"></i></a>
                    </div>--}}
                </div>
            </div>
        </div>
        <div class="row height-60 footer-bottom align-items-center br-top-ebebeb">
            <div class="col-lg-6 col-sm-5">
                <div class="footer-copyright">
                    <p>&copy; Copyright {{ date('Y') }}, BeastlyBot</p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-7">
                <div class="footer-menu pull-right">
                    <ul class="list-none">
                        <li><a href="/terms">Terms of use</a></li>
                        <li><a href="/privacy">Privacy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer ends-->

<!-- modernizr js -->
<script src="{{ asset('site/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<!-- jquery-3.3.1 version -->
<script src="{{ asset('site/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
<!-- jquery-migrate-3.0.0.min.js') }} version -->
<script src="{{ asset('site/assets/js/vendor/jquery-migrate-3.0.0.min.js') }}"></script>
<!-- bootstra.min js -->
<script src="{{ asset('site/assets/js/bootstrap.min.js') }}"></script>
<!-- mmenu js -->
<script src="{{ asset('site/assets/mmenu/dist/mmenu.js') }}"></script>
<script src="{{ asset('site/assets/mmenu/src/mmenu.debugger.js') }}"></script>
<!---venobox-js-->
<script src="{{ asset('site/assets/js/venobox.min.js') }}"></script>
<!---counterup-js-->
<script src="{{ asset('site/assets/js/jquery.counterup.min.js') }}"></script>
<!---waypoints-js-->
<script src="{{ asset('site/assets/js/waypoints.js') }}"></script>
<!---slick-js-->
<script src="{{ asset('site/assets/js/slick.min.js') }}"></script>
<!-- jquery.countdown js -->
<script src="{{ asset('site/assets/js/jquery.countdown.min.js') }}"></script>
<!---isotop-->
<script src="{{ asset('site/assets/js/isotope.pkgd.min.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('site/assets/js/wow.min.js') }}"></script>
<!-- plugins js -->
<script src="{{ asset('site/assets/js/plugins.js') }}"></script>
<!-- main js -->
<script src="{{ asset('site/assets/js/main.js') }}"></script>

@yield('scripts')

</body>
</html>


