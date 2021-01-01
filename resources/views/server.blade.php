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
                            @if($guild->icon == NULL)
                                <img id="server_icon" src="https://i.imgur.com/qbVxZbJ.png" alt="...">
                            @else
                                <img id="server_icon" src="https://cdn.discordapp.com/icons/{{ $id }}/{{ $guild->icon }}.png?size=256" alt="...">
                            @endif
                        </a>
                    </div>
                    <div class="counter counter-md counter text-left">
                        <div class="counter-number-group">
                            <span class="counter-number" id="server_name">{{ $guild->name }}</span>
                        </div>
                    </div>
                </div>
                <div
                    class="d-flex flex-row flex-wrap align-items-center justify-content-between justify-content-lg-end col-xxl-5 col-xl-5 col-lg-6 col-md-12 col-sm-12 mt-md-xx">
                    <div class="d-block d-flex align-items-center payments-switch">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" role="group" id="live-btns">
                                <button class="btn btn-outline @if(!$shop->live)btn-primary active @else btn-success @endif ladda-button" data-plugin="ladda" data-style="zoom-out" data-type="progress" id="test-switch" data-status="Test">
                                    <input type="radio" name="options" autocomplete="off" value="Test" id="basic-test" @if(!$shop->live) checked @endif/>
                                    Test
                                </button>
                                <button class="btn btn-outline @if($shop->live)btn-success active @else btn-primary @endif ladda-button" data-plugin="ladda" data-style="zoom-out" data-type="progress" id="live-switch" data-status="Live">
                                    <input type="radio" name="options" autocomplete="off" value="Live" id="basic-live" @if($shop->live) checked @endif />
                                    Live
                                </button>
                            </div>
                            <button type="button" class="site-action-toggle btn btn-lg btn-dark btn-icon btn-inverse mr-15 ml-15" id="btn-store1"
                                data-toggle="tooltip" data-original-title="https://beastly.store/{{ $shop->url }}"
                                onclick="window.open('{{ env('APP_URL') }}/shop/{{ $shop->url }}')"><i class="front-icon icon-shop @if($shop->live)green-600 @else blue-600 @endif animation-scale-up" id="icon-store1" aria-hidden="true"></i><span class="font-size-14 ml-2">Go to Store</span>
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
                <li class="nav-item">
                    <a class="nav-link tab-shop active show" data-toggle="tab" href="#tab-server" role="tab">
                        <i class="icon icon-shop" aria-hidden="true"></i>
                        <h5>Your Shop</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tap-subscribers" data-toggle="tab" href="#tab-subscribers" role="tab">
                        <i class="icon wb-user" aria-hidden="true"></i>
                        <h5>Subscribers</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-payments" data-toggle="tab" href="#tab-payments" role="tab">
                        <i class="icon wb-stats-bars" aria-hidden="true"></i>
                        <h5>Payments</h5>
                    </a>
                </li>
            </ul>

            <div class="site-sidebar-tab-content tab-content" id="tab-content">

                @include('partials.server.server')
                @include('partials.server.subscribers')
                @include('partials.server.payments')

            </div>


            <!-- pagination -->
            <!--  <ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul> -->
        </div>
    </div>


@endsection


@section('scripts')

<script type="text/javascript">

  $(document).ready(function() {
        $('#live-switch, #test-switch').on('click', function() {
            $('#live-switch, #test-switch').attr('disabled', true);
            var live = $(this).data('status');
        
        @if(!auth()->user()->getStripeHelper()->isExpressUser())

        Swal.fire({
            title: 'Connect Payout Method',
            text: "Before we do that, lets connect your bank to get paid.",
            type: 'info',
            showCancelButton: true,
            showConfirmButton: true,
           // target: document.getElementById('tab-content')
           confirmButtonText: "Get Paid",
        }).then(result => {
            console.log(result);
            if(result.value == true){
                window.location.replace("{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&email=' . auth()->user()->getDiscordHelper()->getEmail() . '&client_id=' . env('STRIPE_CLIENT_ID') }}");
            }
        });


        @elseif(auth()->user()->getStripeHelper()->hasActiveExpressPlan())
            Toast.fire({
                title: 'Going ' + live + ' Mode...',
                // type: 'info',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });

           // Swal.showLoading();

        $.ajax({
            url: `/save-go-live`,
            type: 'POST',
            data: {
                id: '{{ $shop->id }}',
                live: live,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if(msg['success']) {
                if(live == "Live"){
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
                    //title: 'Going ' + live + ' Mode...',
                    text: ' ' + msg['msg'],
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

        @else
            if(live == "Live"){
                $('#partnerPricingModal').modal('show');
            }
        @endif

    });
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

</script>

@include('partials.server.roles_script')
@include('partials.server.server_script')
@include('partials.server.payments_script')

@if(auth()->user()->error == '2' && $shop->live)
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
</script>
<script type="text/javascript">
        setTimeout(function(){
            if(!(jQuery("#roles_table:contains('Active')").length)) {
                $("#btn_edit-roles").click();
                $("#btn_save-roles").addClass('btn-dark').removeClass('btn-primary');

           //     checkPositionPopup();

            }
        }, 200);

</script>
<script type="text/javascript">
        setTimeout(function(){
            if(window.location.href.includes('ready')) {
             $("#live-btns").addClass("pulse");
            }}, 1000);
</script>

@if(!$bot_positioned)
<script>
setTimeout(function(){
        Swal.fire({
            title: 'Oops!',
            text: "Move BeastlyBot to top of roles to begin",
            //type: 'info',
            imageUrl: 'https://beastlybot.com/site/assets/images/role-position-top.gif',
            imageWidth: 600,
            //imageHeight: 400,
            imageAlt: 'Move Top of Roles GIF',
            showCancelButton: false,
            confirmButtonText: "Done. Let's make cash.",
        }).then(result => {
            
        });
    },1000);
</script>
@endif
</script>

@endsection
