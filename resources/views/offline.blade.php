@extends('layouts.app-zero')

@section('title', 'Offline')

@section('content')

<div class="page-header h-300 draw-grad-up">
        <div class="text-center blue-grey-800 m-0 mt-50">
            <a class="avatar avatar-xxl" href="javascript:void(0)">
                <img id="guild_icon"
                     src="{{ asset('block-grey.png') }}"
                     alt="...">
            </a>
            <div class="font-size-50 mb-15 blue-grey-100" id="guild_name">Shop Offline</div>
            <ul class="list-inline font-size-14 text-center">
                <li class="list-inline-item blue-grey-100 text-center">
                    <i class="icon wb-heart mr-5" aria-hidden="true"></i> <span id="guild_member_count">...</span>
                    Members
                </li>
            </ul>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-xl-2 col-lg-1 col-md-12 order-1 order-lg-2">
                <div class="d-flex justify-content-center pt-sm-60">
                    <div class="xx banner-image">
                        <div class="xx-head"></div>
                        <div class="xx-body"></div>
                        <div class="xx-hand"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 order-2 order-lg-1">

                <div class="row pt-30">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="panel-body p-0 text-center">
                                <h1><i class="icon-discord"></i></h1>
                                <h4 class="text-white">Sorry, shop is currently offline.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- if active subscription -->
    <div class="site-action" data-plugin="actionBtn">
        <button type="button" class="site-action-toggle btn-raised btn btn-primary" onclick=" window.open('/dashboard')">
            <i class="front-icon icon-dashboard animation-scale-up" aria-hidden="true"></i>Dashboard
        </button>
    </div>

@endsection
