<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- start bar-->
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega site-menubar-fold"
     role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler navbar-sm-open collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <a class="navbar-brand navbar-brand-center text-center" href="{{ Request::is('dashboard') ? 'https://beastlybot.com' : '/dashboard' }}">
            <img class="navbar-brand-logo navbar-brand-logo-normal" src="/site/assets/images/beastlybot-sq-2-w.png"
                 title="Beastly Bot">
        </a>
        <button type="button" class="navbar-toggler collapsed hidden-xs-down" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>


    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <!--<ul class="nav navbar-toolbar">

                <li class="nav-item hidden-float">
                    <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>

            </ul>-->
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
               {{-- <li class="nav-item dropdown">
                    @auth

                   <a class="nav-link" href="javascript:void(0)" data-toggle="slidePanel" data-url="/slide-notifications" title="Notifications">
                    <i class="icon wb-bell" aria-hidden="true" id="notification_bell"></i>
                    <span class="badge badge-pill badge-default up" id="notification_count_1">0</span>
                    </a>
                    @endauth
                </li> --}}
                {{-- <li class="nav-item dropdown"> --}}
                {{--     @include('partials.messages') --}}
                {{-- </li> --}}

     
                <li class="nav-item">
                   <a class="nav-link" href="#?messages" data-toggle="slidePanel" data-url="/slide-tickets-list" title="Messages" id="open-messages">
                    <i class="icon wb-chat" aria-hidden="true"></i>
                    <span class="badge badge-pill badge-default up">{{ App\Ticket::where('user_id', auth()->user()->id)->where('read', 0)->get()->count() }}</span>
                    </a>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link navbar-avatar" href="javascript:void(0)" data-toggle="site-sidebar" data-url="/slide-account-settings" role="button">
                        <span class="avatar avatar-online">
                            <img src="{{ auth()->user()->getDiscordHelper()->getAvatar() }}" alt="User">
                            <i></i>
                        </span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <!--<div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search" class="mb-0">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search a question...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>-->
        <!-- End Site Navbar Seach -->
    </div>
</nav>
<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">

                    <li class="dropdown site-menu-item mt-15 mt-md-20 mt-lg-25 mt-xl-50 has-sub {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a data-toggle="dropdown" href="/dashboard" data-dropdown-toggle="false">
                            <i class="site-menu-icon wb-grid-4" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown site-menu-item mt--5 has-sub {{ Request::is('account/subscriptions') ? 'active' : '' }}">
                        <a data-toggle="dropdown" href="/account/subscriptions" data-dropdown-toggle="false">
                            <i class="site-menu-icon wb-star" aria-hidden="true"></i>
                            <span class="site-menu-title">Subscriptions</span>
                        </a>
                    </li>
                    <!-- <li class="dropdown site-menu-item has-section has-sub {{ Request::is('account/payments') ? 'active' : '' }}">
                        <a data-toggle="dropdown" href="/account/payments" data-dropdown-toggle="false">
                            <i class="site-menu-icon wb-order" aria-hidden="true"></i>
                            <span class="site-menu-title">Payments</span>
                        </a>
                    </li> -->
                    <li class="site-menu-category">SHOP
                        @if(auth()->user()->StripeConnect->express_id != null)
                        <a href="#" class="site-menu-badge" data-toggle="slidePanel" data-url="/slide-payout">
                            <span class="badge badge-pill badge-primary text-capitalize mt-10">Payout</span>
                        </a>
                        @else
                        <a href="#auto-open" class="site-menu-badge" data-toggle="site-sidebar" data-url="/slide-help-ultimate-shop-guide">
                            <span class="badge badge-pill badge-dark text-capitalize mt-10">Tutorial</span>
                        </a>
                        @endif
                    </li>
                    @if(auth()->user()->StripeConnect->express_id != null && auth()->user()->error != "1")
                        <li class="dropdown site-menu-item {{ Request::is('servers') ? 'active' : '' }}">
                            <a data-toggle="dropdown" href="/servers">
                                <i class="site-menu-icon icon-shop" aria-hidden="true"></i>
                                <span class="site-menu-title">Servers</span>
                            </a>
                        </li>
                        <li class="dropdown site-menu-item {{ Request::is('promotions') ? 'active' : '' }}">
                            <a data-toggle="dropdown" href="/promotions">
                                <i class="site-menu-icon icon-gift1" aria-hidden="true"></i>
                                <span class="site-menu-title">Promotions</span>
                            </a>
                        </li>
                    @else
                    @if(\App\DiscordStore::where('user_id', auth()->user()->id)->exists())
                    <li class="dropdown site-menu-item {{ Request::is('servers') ? 'active' : '' }}">
                            <a data-toggle="dropdown" href="/servers">
                                <i class="site-menu-icon icon-shop" aria-hidden="true"></i>
                                <span class="site-menu-title">Servers</span>
                            </a>
                        </li>
                    @else

                    <li class="dropdown site-menu-item has-sub">
                        <a href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="site-menu-icon icon-shop" aria-hidden="true"></i>
                            <span class="site-menu-title">Create Shop</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <button type="button" class="btn btn-primary btn-block rounded-0 ladda-button" id="tour_connect-stripe"
                                    onclick="window.open('{{ 'https://discordapp.com/oauth2/authorize?client_id=' . env('DISCORD_CLIENT_ID') . '&scope=bot&permissions=' . env('DISCORD_BOT_PERMISSIONS') }}')"
                                    data-style="slide-up" data-plugin="ladda">
                                    <i class="icon wb-info-circle l-up" aria-hidden="true"
                                        data-plugin="webuiPopover"
                                        data-content="&lt;p&gt;@To create a shop add BeastlyBot to your Discord server.&lt;/p&gt;" data-trigger="hover"
                                        data-animation="pop"></i>
                                    <i class="icon-discord ladda-label" aria-hidden="true"></i>
                                    <br>
                                    <span class="ladda-label">Connect Bot</span>
                                    <span class="ladda-spinner"></span>
                                </button>
                            </li>
                        </ul>
                    </li>

                    @endif
                    {{--<li class="dropdown site-menu-item has-sub">
                        <a href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="site-menu-icon icon-shop" aria-hidden="true"></i>
                            <span class="site-menu-title">Create Shop</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <button type="button" class="btn btn-primary btn-block rounded-0 ladda-button" id="tour_connect-stripe"
                                    onclick="window.location.href = '{{ \App\StripeHelper::getConnectURL() }}';"
                                    data-style="slide-up" data-plugin="ladda">
                                    <i class="icon wb-info-circle l-up" aria-hidden="true"
                                        data-plugin="webuiPopover"
                                        data-content="&lt;p&gt;@lang('lang.connect_stripe')&lt;/p&gt;" data-trigger="hover"
                                        data-animation="pop"></i>
                                    <i class="icon-stripe ladda-label" aria-hidden="true"></i>
                                    <br>
                                    <span class="ladda-label">Connect Stripe</span>
                                    <span class="ladda-spinner"></span>
                                </button>
                            </li>
                        </ul>
                    </li>--}}
                    @endif
                    <!--<li class="site-menu-category">Help</li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="site-menu-icon wb-plugin" aria-hidden="true"></i>
                            <span class="site-menu-title">Learn</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="/help">
                                    <span class="site-menu-title">Managing Subscriptions</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="#">
                                    <span class="site-menu-title">Ultimate Shop Guide</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="/help">
                                    <span class="site-menu-title">Withdraw Earnings</span>
                                </a>
                            </li>
                        </ul>

                    </li>-->
                    <li class="site-menu-category">Beastly</li>
                       <li class="site-menu-item">
                            <a href="https://beastlybot.com/about">
                                <i class="site-menu-icon icon-discord" aria-hidden="true"></i>
                                <span class="site-menu-title">About</span>
                            </a>
                        </li>
                       {{-- <li class="site-menu-item">
                            <a href="/blog">
                                <i class="site-menu-icon wb-heart" aria-hidden="true"></i>
                                <span class="site-menu-title">Blog</span>
                            </a>
                        </li> --}}
                </ul>
                <div class="site-menubar-section mt-20">
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-around">
                    <!--<a href="#" class="btn btn-dark btn-outline btn-icon"><i class="icon-twitter"></i></a>
                    <a href="#" class="btn btn-dark btn-outline btn-icon"><i class="icon-facebook"></i></a>-->
                    <a href="https://discord.gg/4Gs2N35" target="_blank" class="btn btn-dark btn-outline btn-icon"><i class="icon-discord"></i></a>
                    </div>
                </div>
                <!--<div class="site-menubar-footer">
                    <a href="#" class="fold-show" id="dark-day">
                        <span class="icon wb-eye" aria-hidden="true"></span>
                    </a>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!-- end bar -->


