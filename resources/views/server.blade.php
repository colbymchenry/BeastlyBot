@extends('layouts.app')

@section('title', 'Server')

@section('content')
    <div class="page-main">
        <div id="serverMain" class="page-content page-content-table" data-plugin="selectable">
            <!-- Card -->
            <div class="card card-shadow bg-grey-4 flex-row justify-content-between row m-0 p-0 pt-30 pb-20">
                <div class="d-flex flex-row flex-wrap align-items-center col-xxl-7 col-xl-7 col-lg-6 col-md-12 col-sm-12">
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
                    class="d-flex flex-row flex-wrap align-items-center justify-content-between justify-content-lg-end col-xxl-5 col-xl-5 col-lg-6 col-md-12 col-sm-12 mt-md-xx">
                    <div class="d-block d-flex align-items-center payments-switch">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" role="group" id="live-btns">
                                <button class="btn btn-outline @if(!$shop->testing)btn-primary active @else btn-success @endif ladda-button" data-plugin="ladda" data-style="zoom-out" data-type="progress" id="test-switch" data-status="Test">
                                    <input type="radio" name="options" autocomplete="off" value="Test" id="basic-test" @if(!$shop->testing) checked @endif/>
                                    Test
                                </button>
                                <button class="btn btn-outline @if($shop->testing)btn-success active @else btn-primary @endif ladda-button" data-plugin="ladda" data-style="zoom-out" data-type="progress" id="live-switch" data-status="Live">
                                    <input type="radio" name="options" autocomplete="off" value="Live" id="basic-live" @if($shop->testing) checked @endif />
                                    Live
                                </button>
                            </div>
                            <button type="button" class="site-action-toggle btn btn-lg btn-dark btn-icon btn-inverse mr-15 ml-15" id="btn-store1"
                                data-toggle="tooltip" data-original-title="{{ env('SHOP_URL') }}/{{ $shop->url }}"
                                onclick="window.open('{{ env('SHOP_URL') }}/{{ $shop->url }}')"><i class="front-icon icon-shop @if($shop->testing)green-600 @else blue-600 @endif animation-scale-up" id="icon-store1" aria-hidden="true"></i><span class="font-size-14 ml-2">Go to Store</span>
                            </button>
                    </div>
                    <button type="button" class="btn mt-0 ml-30 btn-sm btn-icon btn-dark btn-round mr-lg-30"
                            data-url="/slide-server-settings/{{ $id }}" data-toggle="slidePanel">
                        <i class="icon wb-settings" aria-hidden="true"></i>
                    </button>
                </div>
            </div>


            <!-- nav-tabs -->
            <ul class="site-sidebar-nav nav nav-tabs nav-tabs-line bg-grey-3" role="tablist">
                <li class="nav-item" onclick="fillRecentPayments();">
                    <a class="nav-link active show" data-toggle="tab" href="#tab-server" role="tab">
                        <i class="icon icon-shop" aria-hidden="true"></i>
                        <h5>Your Shop</h5>
                    </a>
                </li>
                <li class="nav-item" onclick="javascript:loadSubs();">
                    <a class="nav-link" data-toggle="tab" href="#tab-subscribers" role="tab">
                        <i class="icon wb-user" aria-hidden="true"></i>
                        <h5>Subscribers</h5>
                    </a>
                </li>
                <li class="nav-item" onclick="javascript:loadPayments();">
                    <a class="nav-link" data-toggle="tab" href="#tab-payments" role="tab">
                        <i class="icon wb-stats-bars" aria-hidden="true"></i>
                        <h5>Payments</h5>
                    </a>
                </li>
            </ul>

            <div class="site-sidebar-tab-content tab-content" id="tab-content">

                @include('partials.server.server')
                @include('partials.server.subscribers')
                {{-- @include('partials.server.affiliates') --}}
                @include('partials.server.payments')

            </div>


            <!-- pagination -->
            <!--  <ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul> -->
        </div>
    </div>
<!--
    <div class="site-action hidden-sm-down" data-plugin="actionBtn">
        <button type="button" class="site-action-toggle btn-raised btn btn-primary" id="btn-store2"
                onclick="window.open('{{ env('APP_URL') }}/shop/{{ $shop->url }}')">
            <i class="front-icon icon-shop animation-scale-up mr-2" aria-hidden="true"></i>Store Front
        </button>
    </div>-->

@endsection

@section('scripts')

<script type="text/javascript">

  $(document).ready(function() {
        $('#live-switch, #test-switch').on('click', function() {
            $('#live-switch, #test-switch').attr('disabled', true);
            var testing = $(this).data('status');

            console.log(testing);

        @if(auth()->user()->canAcceptPayments())
            Toast.fire({
                title: 'Going ' + testing + ' Mode...',
                // type: 'info',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });

           // Swal.showLoading();

        @else
            if(testing == "Live"){
                $('#partnerPricingModal').modal('show');
            }
        @endif

        @if(auth()->user()->canAcceptPayments())
        $.ajax({
            url: `/save-go-live`,
            type: 'POST',
            data: {
                id: '{{ $shop->id }}',
                testing: testing,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if(msg['success']) {
                if(testing == "Live"){
                    $("#test-switch").addClass('btn-success', 'active').removeClass('btn-primary');
                    $("#live-switch").addClass('btn-success').removeClass('btn-primary', 'active');
                    setTimeout(function(){
                        $("#live-switch").removeClass('focus');
                        $('#btn-store1').addClass("btn-success");
                        $('#icon-store1').addClass("green-600").removeClass("blue-600");;
                        $('#btn-store2').addClass("btn-success").removeClass("btn-primary");
                        Toast.fire({
                            title: 'Done!',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    },2000)
                }else{
                    $("#test-switch").addClass('btn-primary', 'active').removeClass('btn-success');
                    $("#live-switch").addClass('btn-primary').removeClass('btn-success', 'active');
                    setTimeout(function(){
                        $("#test-switch").removeClass('focus');
                        $('#btn-store1').removeClass("btn-success");
                        $('#icon-store1').addClass("blue-600").removeClass("green-600");;
                        $('#btn-store2').addClass("btn-primary").removeClass("btn-success");
                        Toast.fire({
                            title: 'Done!',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    },2000)
                }
            } else {
                Toast.fire({
                    title: 'Going ' + testing + ' Mode...',
                    text: msg['msg'],
                    type: 'warning',
                    showCancelButton: false,
                    showConfirmButton: false,
                });
                //$('#partnerPricingModal').modal('show');
            }
            setTimeout(function(){
            $('#live-switch, #test-switch').attr('disabled', false);
            },3000)
        });

        @endif

    })
})


$('#partnerPricingModal').on('hidden.bs.modal', function () {
            if ($('#live-switch').hasClass('active')) {
                $("#test-switch").addClass('btn-primary active').removeClass('btn-success');
                $("#live-switch").addClass('btn-primary').removeClass('active btn-success');
                $('#icon-store1').addClass("blue-600").removeClass("green-600");
                $('#btn-store1').removeClass("btn-success");
                $('#btn-store2').addClass("btn-primary").removeClass("btn-success");
            }
        });

/*
$(document).ready(function() {
        $('#test-switch').on('click', function() {

        Swal.fire({
            title: 'Test Mode...',
            // type: 'info',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false
        });

        Swal.showLoading();

        var base_url = "{{ env('APP_URL') }}/shop/";
        var testing = $("#basic-test").val();

        $.ajax({
            url: `/save-go-live`,
            type: 'POST',
            data: {
                id: '{{ $shop->id }}',
                testing: $("#basic-test").val(),
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if(msg['success']) {
                Swal.fire({
                    title: 'Done!',
                    type: 'success',
                    showCancelButton: false,
                    showConfirmButton: true,
                });

                $("#test-switch").addClass('btn-primary', 'active').removeClass('btn-success');
                $("#live-switch").addClass('btn-primary').removeClass('btn-success', 'active');
                setTimeout(function(){
                    $("#test-switch").removeClass('focus');
                    $('#btn-store1').removeClass("btn-success");
                    $('#icon-store1').addClass("blue-600").removeClass("green-600");;
                    $('#btn-store2').addClass("btn-primary").removeClass("btn-success");
                },2000)
            } else {
                Swal.fire({
                    title: 'Test Mode...',
                    text: msg['msg'],
                    type: 'warning',
                    showCancelButton: false,
                    showConfirmButton: true,
                });
            }
        });
    })
}) */
    </script>
    @include('partials.server.roles_script')
    @include('partials.server.subscribers_script')
    @include('partials.server.server_script')
    @include('partials.server.payments_script')
@if(auth()->user()->error == '2' && $shop->testing)
<script type="text/javascript">
        setTimeout(function(){
             $("#test-switch").click();
        }, 3000);
</script>
@endif
<script type="text/javascript">
        setTimeout(function(){
            if((window.location.href.includes('guide-ultimate=true'))) {
             $(".slide-button-ultimate").click();
             location.hash = "auto-open";
        }}, 2000);
</script><!--
<script type="text/javascript">
        setTimeout(function(){
            if(!(jQuery("#roles_table:contains('Active')").length)) {
                $("#btn_edit-roles").click();
                $("#btn_save-roles").addClass('btn-dark').removeClass('btn-primary');
            }
        }, 1500);
</script>-->
<script type="text/javascript">
        setTimeout(function(){
            if(window.location.href.includes('ready')) {
             $("#live-btns").addClass("pulse");
            }}, 1000);
</script>

@endsection