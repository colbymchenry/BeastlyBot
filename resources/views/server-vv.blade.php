@extends('layouts.app')

@section('title', 'Server')

@section('content')
    <div class="page-main">
        <div id="serverMain" class="page-content page-content-table" data-plugin="selectable">
            <!-- Card -->
            <div class="card card-shadow bg-grey-100 flex-row justify-content-between row m-0 p-0 pt-30 pb-20">
                <div class="d-flex flex-row flex-wrap align-items-center col-xxl-8 col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <div class="white w-80 ml-lg-30">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                            <img id="server_icon" src="" alt="...">
                        </a>
                    </div>
                    <div class="counter counter-md counter text-left">
                        <div class="counter-number-group">
                            <span class="counter-number" id="server_name">...</span>
                        </div>
                        <div class="counter-label text-capitalize font-size-16" id="member_count">... Members
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex flex-row flex-wrap align-items-center justify-content-between justify-content-lg-end col-xxl-4 col-xl-3 col-lg-4 col-md-12 col-sm-12 mt-md-xx">
                    <div class="d-block d-flex align-items-center payments-switch">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons"  role="group">
                                <label class="btn btn-outline btn-primary active ladda-button" data-plugin="ladda" data-style="zoom-out" data-type="progress" id="test-switch">
                                    <input type="radio" name="options" autocomplete="off" value="test" checked />
                                    Test
                                </label>
                                <label class="btn btn-outline btn-primary ladda-button" data-plugin="ladda" data-style="zoom-out" data-type="progress" id="live-switch">
                                    <input type="radio" name="options" autocomplete="off" value="live"/>
                                    Live
                                </label>
                            </div>

                        <button type="button" class="site-action-toggle btn btn-icon btn-inverse mr-15 ml-15" id="btn-store1"
                        data-toggle="tooltip" data-original-title="{{ env('APP_URL') }}/shop/{{ $shop->url }}"
                        onclick="window.open('{{ env('APP_URL') }}/shop/{{ $shop->url }}')">
                            <i class="front-icon icon-shop blue-600 animation-scale-up" id="icon-store1" aria-hidden="true"></i>
                        </button>
                    </div>
                    <button type="button" class="btn mb-1 ml-30 btn-sm btn-icon btn-inverse btn-round mr-lg-30"
                            data-url="/slide-server-settings/{{ $id }}" data-toggle="slidePanel">
                        <i class="icon wb-settings" aria-hidden="true"></i>
                    </button>
                </div>
            </div>


            <!-- nav-tabs -->
            <ul class="site-sidebar-nav nav nav-tabs nav-tabs-line bg-blue-grey-100" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-server" role="tab">
                        <i class="icon icon-shop" aria-hidden="true"></i>
                        <h5>Your Shop</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-subscribers" role="tab">
                        <i class="icon wb-user" aria-hidden="true"></i>
                        <h5>Subscribers</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-payments" role="tab">
                        <i class="icon wb-stats-bars" aria-hidden="true"></i>
                        <h5>Payments</h5>
                    </a>
                </li>
            </ul>

            <div class="site-sidebar-tab-content tab-content">

                @include('partials.server.server')
                @include('partials.server.subscribers')
                {{-- @include('partials.server.affiliates') --}}
                @include('partials.server.payments')

            </div>


            <!-- pagination -->
            <!--  <ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul> -->
        </div>
    </div>

    <div class="site-action hidden-sm-down" data-plugin="actionBtn">
        <button type="button" class="site-action-toggle btn-raised btn btn-primary" id="btn-store2"
                onclick="window.open('{{ env('APP_URL') }}/shop/{{ $shop->url }}')">
            <i class="front-icon icon-shop animation-scale-up mr-2" aria-hidden="true"></i>Store Front
        </button>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('#live-switch').on('click', function() {
                @if(!auth()->user()->canAcceptPayments())
                $('#partnerPricingModal').modal('show');
                @endif
                $("#test-switch").addClass('btn-success').removeClass('btn-primary');
                $("#live-switch").addClass('btn-success').removeClass('btn-primary');
                setTimeout(function(){
                    $("#live-switch").removeClass('focus');
                    $('#btn-store1').addClass("btn-success");
                    $('#icon-store1').addClass("green-600").removeClass("blue-600");;
                    $('#btn-store2').addClass("btn-success").removeClass("btn-primary");
                },2000)
            });
            $('#test-switch').on('click', function() {
                $("#test-switch").addClass('btn-primary').removeClass('btn-success');
                $("#live-switch").addClass('btn-primary').removeClass('btn-success');
                setTimeout(function(){
                    $("#test-switch").removeClass('focus');
                    $('#btn-store1').removeClass("btn-success");
                    $('#icon-store1').addClass("blue-600").removeClass("green-600");;
                    $('#btn-store2').addClass("btn-primary").removeClass("btn-success");
                },2000)
            });
            $('#partnerPricingModal').on('hidden.bs.modal', function () {
                if ($('#live-switch').hasClass('active')) {
                    $("#test-switch").addClass('btn-primary active').removeClass('btn-success');
                    $("#live-switch").addClass('btn-primary').removeClass('active btn-success');
                    $('#icon-store1').addClass("blue-600").removeClass("green-600");
                    $('#btn-store1').removeClass("btn-success");
                    $('#btn-store2').addClass("btn-primary").removeClass("btn-success");
                }
            });
        });
    </script>

    @include('partials.server.roles_script')
    @include('partials.server.subscribers_script')
    @include('partials.server.server_script')
    @include('partials.server.payments_script')

<script type="text/javascript">
        setTimeout(function(){
            if((window.location.href.includes('guide-ultimate=true')) || !(jQuery("#roles_table:contains('Active')").length)) {
             $(".slide-button-ultimate").click();
             location.hash = "auto-open";
        }}, 2000);
</script>
@endsection
