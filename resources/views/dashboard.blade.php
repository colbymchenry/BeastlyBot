@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<div class="page-aside">

<div class="page-aside-switch">
  <i class="icon wb-chevron-left" aria-hidden="true"></i>
  <i class="icon wb-chevron-right" aria-hidden="true"></i>
</div>

<div class="page-aside-inner page-aside-scroll">
  <div data-role="container">
    <div data-role="content">
    @if(auth()->user()->getStripeHelper()->isExpressUser())
    <div class="card card-shadow card-inverse mb-0 bg-grey-3 white">
      <div class="card-block p-20">
        <div class="counter counter-lg counter-inverse text-left">
          <div class="counter-label mb-20">
            <div>LATEST PAYOUT <i class="icon wb-info-circle ml-1 text-white" aria-hidden="true"
              data-plugin="webuiPopover"
              data-content="&lt;p&gt;Your shops recent payed out balance, on the way to your bank. You’ll receive payouts daily.&lt;/p&gt;" data-trigger="hover"
              data-animation="pop"></i></div>
          </div>
          <div class="counter-number-group mb-5">
            <span class="counter-number-related">$</span>
            <span class="counter-number">{{ number_format(($stripe_helper->getBalance()->available[0]->amount)/100, 2, '.', ',') }}</span>
            {{--v1 <button type="button" class="btn btn-primary btn-sm btn-link float-right" data-toggle="site-sidebar" data-url="/slide-payout/{{ auth()->user()->stripe_express_id }}">View Pending</button>--}}
            <button type="button" class="btn btn-success btn-sm float-right ladda-button" data-style="slide-up" data-plugin="ladda" onclick="window.open('{{ $stripe_helper->getLoginURL() }}', '_blank');">
                <span class="ladda-label">Payouts <i class="wb-arrow-right ml-1"></i></span>
                <span class="ladda-spinner"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="card">
              <div class="card-header">
              Shop Guilds
              </div> 
              <div class="card-block p-0">
                <ul class="list-group list-group-full list-group-dividered list-group-no-hover mb-0" id="guilds-dropdown">
           

                  {{--<li class="list-group-item px-5">
                    <div class="d-flex align-items-start">
                      <div class="pl-2 pr-10">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="https://cdn.discordapp.com/icons/608894397328785440/9cd0dbd96c17009815b7a0f90ac05a33.jpg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-5 mb-5">Other Servers</h5>
                        <small>123 Members</small>
                      </div>
                      <div class="pl-5">
                        <button type="button" class="btn btn-primary btn-outline mt-5">Invite</button>
                      </div>
                    </div>
                  </li>--}}

                </ul>
              </div>
            </div>

    </div>
  </div>
</div>
<!---page-aside-inner-->
</div>

<div class="page-main pb-100">
<div class="container-fluid pt-20 px-lg-30">

      <!-- start big row -->
      <div class="row">
        <div class="col-12">
          <h4 class="font-weight-100">Dashboard</h4>
        </div>
        <div class="col-12 order-2 order-md-1">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="row no-space">

                    <div class="col-lg col-xs-9 col-sm-9 col-md-10 px-0">
                        <div class="card-block h-150 bg-grey-2 overlay">
                          <div class="overlay-panel vertical-align">
                            <div class="vertical-align-middle prof">
                              <a class="avatar avatar-100 float-left prof-20 mr-20" href="javascript:void(0)">
                                <img src="{{ auth()->user()->getDiscordHelper()->getAvatar() }}" alt="">
                              </a>

                              <div class="float-left text-white">
                                <div class="font-size-20 mt-20">{{ auth()->user()->getDiscordHelper()->getUsername() }}</div>
                                  <p class="mb-20 text-nowrap">
                                    <span class="text-break">{{ auth()->user()->getDiscordHelper()->getEmail() }}</span>
                                  </p>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-1 col-xs-3 col-sm-3 col-md-2">

                        <div class="row no-space">
                            {{-- <div class="@if(auth()->user()->getStripeHelper()->hasActiveExpressPlan())col-6 col-sm-12 @else col-12 h-only-xs-50 @endif">
                              <a href="javascript:void(0);" class="btn-75 @if(auth()->user()->getStripeHelper()->hasActiveExpressPlan())pt-20 @else h-150 pt-10 pt-sm-60 @endif bd-top-sm" data-toggle="site-sidebar" data-url="/slide-account-settings"> --}}
                              <div class="col-12 h-only-xs-50" >
                              <a href="javascript:void(0);" class="btn-75 h-150 pt-10 pt-sm-60 bd-top-sm" data-toggle="site-sidebar" data-url="/slide-account-settings">
                                <i class="wb-more-horizontal"></i>
                              </a>
                            </div>
                           {{-- @if(auth()->user()->StripeConnect->express_id != null && auth()->user()->error != '1')
                            <div class="col-6 col-sm-12">
                              <a href="javascript:void(0);" class="btn-75 pt-25 bd-top" data-toggle="site-sidebar" data-url="/slide-payout/{{ auth()->user()->StripeConnect->express_id }}">
                                  <i class="icon-stripe"></i>
                              </a>
                            </div>
                            @endif --}}

                          </div>

                    </div>

                      <div class="col-12 col-md-9 col-lg-5 col-xl-3">
                        <div class="card-block h-150 h-only-xs-100 h-only-sm-100 h-only-md-100 bg-grey-3 draw-grad-up">
                          <div class="slider pt-0 mx-5" id="subscriptionsSlider">
                          @if(auth()->user()->getStripeHelper()->hasActiveExpressPlan())
                            <div>
                              <div class="text-center mt-lg-30">
                                <span class="badge badge-success badge-lg font-size-18">Live</span>
                                <div class="d-block wb-check green-600 pt-1"></div>
                                <p class="font-weight-100 mt--3">{{ gmdate("M d Y", auth()->user()->getPlanExpiration()) }}</p>
                              </div>
                            </div>
                          @endif
                          @foreach(auth()->user()->getStripeHelper()->getSubscriptions('active') as $subscription)

                            @php
                                $plan_id = $subscription['items']['data'][0]['plan']['id'];
                            @endphp

                            @if(strpos($plan_id, 'discord_') !== false)

                            @php
                                $data = explode('_', $plan_id);
                                $guild = $discord_helper->getGuild($data[1]);
                                $role = $discord_helper->getRole($data[1], $data[2]);
                            @endphp

                          <div>
                            <div class="text-center mt-lg-30" onclick="window.location.href = '/account/subscriptions';">
                              <div class="badge badge-primary badge-lg font-size-18 text-truncate" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</div>
                              <div class="d-block wb-check green-600 pt-1"></div>
                              <p class="font-weight-100 mt--3">{{ date("m-d-Y", $subscription['current_period_end']) }}</p>
                            </div>
                          </div>

                          @endif
                          @endforeach

                          </div>
                        </div>
                      </div>
                      <!--<div class="col-md-4 hidden-md-down">
                        <div class="card-block h-150 h-only-xs-100 bg-grey-2">
                          <div class="mt-40 w-150 mx-auto">
                            <div class="d-flex justify-content-around">
                              <div>
                                <a href="#" class="btn btn-icon btn-dark btn-round"><i class="icon wb-settings"></i></a>
                              </div>
                              <div>
                                <a href="#" class="btn btn-dark">Payout</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>-->

                    </div>

                </div> <!-- end card -->


              </div> <!-- end col -->

          </div> <!-- end row -->



        </div> <!-- end first column -->

        <div class="col-12 order-1 order-md-2"> <!-- begin next column -->

        <div class="row">
            <!--<div class="col-12 hidden-md-down visible-xs-down">
              <p class="mb-2 font-weight-100">Account</p>
            </div>-->
            <div class="col-12 col-sm-6">
                <a href="/account/subscriptions" class="card card-block card-hover mb-25" id="tour_subscriptions-block">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-15"><i class="icon wb-star text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Subscriptions</span>
                      </div>
                    </div>
              </a>
            </div>

            <!--<div class="col-6 col-sm-3">
                <a href="javascript:void(0);" class="card card-block card-hover mb-25">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-md-100 h-only-xs-100 h-only-sm-100" data-toggle="slidePanel" data-url="/slide-account-payments">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-15"><i class="icon wb-order text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Payments</span>
                      </div>
                    </div>
                </a>
            </div>-->



            <!--<div class="col-6 col-md-4 col-lg-3 col-xxl-3">
                <a href="/account/settings" class="card card-block btn btn-primary">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-md-150 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon wb-user-circle text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Settings</span>
                      </div>
                    </div>
                </a>
            </div>-->

          @if(auth()->user()->getStripeHelper()->isExpressUser())

            {{--V1 
            @if(auth()->user()->error == "1")


            <div class="col-12 col-sm-6">
                <a href="javascript:void(0);" class="card card-block pulse card-hover"
                    id="btn_start-shop-block">
                    <i class="icon wb-info-circle l-up text-white" aria-hidden="true"
                      data-plugin="webuiPopover"
                      data-content="&lt;p&gt;Once connected you must re-enable all active Products and reset all prices. Your Live account is still active for the term. Please contact support at with any other concerns (team@beastly.app).&lt;/p&gt;" data-trigger="hover"
                      data-animation="pop"></i>
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon-shop text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Stripe Payment Failure</span>
                        <p class="font-size-12 text-white">Please connect a US Stripe account.</p>
                      </div>
                    </div>
                </a>
                <a href="{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&client_id=' . env('STRIPE_CLIENT_ID') }}" class="d-none card card-block btn btn-primary bg-blue-600 ladda-button"
                    id="btn_connect-stripe-block" data-style="slide-up" data-plugin="ladda">
                    <i class="icon wb-info-circle l-up text-white" aria-hidden="true"
                      data-plugin="webuiPopover"
                      data-content="&lt;p&gt;@lang('lang.connect_stripe') (MUST BE USA ACCOUNT)&lt;/p&gt;" data-trigger="hover"
                      data-animation="pop"></i>
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-100">
                      <div class="vertical-align-middle ladda-label">
                        <div class="counter-icon mb-5"><i class="icon-stripe text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Connect Stripe</span>
                      </div>
                      <span class="ladda-spinner"></span>
                    </div>
                </a>
            </div>

            <script type="text/javascript">
                function changeBtn() {
                    $('#btn_connect-stripe-block').removeClass('d-none');
                    $('#btn_start-shop-block').addClass('d-none');
                }
                window.onload = function () {
                    document.getElementById("btn_start-shop-block").addEventListener('click', changeBtn);
                }
            </script>


            @else --}}

           <!--<div class="col-12 hidden-md-down visible-xs-down">
              <p class="mb-1 font-weight-100">Shop</p>
            </div>-->
            <div class="col-6 col-sm-3">
                <a href="javascript:void(0);" class="card card-block card-hover" id="servers-block" data-toggle="slidePanel" data-url="/servers?slide=true">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-15"><i class="icon icon-shop text-white font-size-50 mb--10" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Shops</span>
                      </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-sm-3">
                <a href="javascript:void(0);" class="card card-block card-hover" data-toggle="slidePanel" data-url="/promotions?slide=true">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-15"><i class="icon icon-gift1 text-white font-size-50 mb--10" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Promotions</span>
                      </div>
                    </div>
                </a>
            </div>

            <!--<div class="col-6 col-lg-3 col-xxl-3">
                <a href="javascript:void(0);" class="card card-block btn btn-primary" data-toggle="slidePanel" data-url="slide-payout">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-md-150 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon icon-right-big text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Payout</span>
                      </div>
                    </div>
                </a>
            </div>-->

            {{-- @endif --}}


          @else

            <div class="col-12 col-sm-6">
                <!--<a href="javascript:void(0);" class="card card-block card-hover"
                    id="btn_start-shop-block">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon-shop text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Add Bot</span>
                      </div>
                    </div>
                </a>-->
                <a href="{{ 'https://discordapp.com/oauth2/authorize?client_id=' . env('DISCORD_CLIENT_ID') . '&scope=bot&permissions=' . env('DISCORD_BOT_PERMISSIONS') }}" target="_blank" class="card card-block btn btn-primary bg-blue-600 ladda-button"
                    id="btn_start-shop-block" data-style="slide-up" data-plugin="ladda">
                    <i class="icon wb-info-circle l-up text-white" aria-hidden="true"
                      data-plugin="webuiPopover"
                      data-content="&lt;p&gt;To create a shop add BeastlyBot to your Discord server.&lt;/p&gt;" data-trigger="hover"
                      data-animation="pop"></i>
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-100">
                      <div class="vertical-align-middle ladda-label">
                        <div class="counter-icon mb-5"><i class="icon-discord text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Add Bot</span>
                      </div>
                      <span class="ladda-spinner"></span>
                    </div>
                </a>
                {{--<a href="{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&client_id=' . env('STRIPE_CLIENT_ID') }}" class="d-none card card-block btn btn-primary bg-blue-600 ladda-button"
                    id="btn_connect-stripe-block" data-style="slide-up" data-plugin="ladda">
                    <i class="icon wb-info-circle l-up text-white" aria-hidden="true"
                      data-plugin="webuiPopover"
                      data-content="&lt;p&gt;@lang('lang.connect_stripe')&lt;/p&gt;" data-trigger="hover"
                      data-animation="pop"></i>
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-100">
                      <div class="vertical-align-middle ladda-label">
                        <div class="counter-icon mb-5"><i class="icon-stripe text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Connect Stripe</span>
                      </div>
                      <span class="ladda-spinner"></span>
                    </div>
                </a>--}}
                <a href="javascript:void(0);" class="d-none card card-block card-hover pulse"
                    id="btn_connect-stripe-block" data-toggle="slidePanel" data-url="/servers?slide=true">
                    <div class="counter counter-lg counter-inverse blue-grey-100 vertical-align h-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon-shop text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Shops</span>
                      </div>
                    </div>
                </a>
            </div>

            <script type="text/javascript">
                function changeBtn() {
                  setTimeout(function(){
                    $('#btn_connect-stripe-block').removeClass('d-none');
                    $('#btn_start-shop-block').addClass('d-none');
                  },2000);
                }
                window.onload = function () {
                    document.getElementById("btn_start-shop-block").addEventListener('click', changeBtn);
                }
                @if(\App\DiscordStore::where('user_id', auth()->user()->id)->exists())
                window.onload = function () {
                  $('#btn_connect-stripe-block').removeClass('d-none');
                  $('#btn_start-shop-block').addClass('d-none');
                }
                @endif
            </script>

          @endif

          </div>


        </div>

      </div><!-- end row -->

    <div class="row">
      <div class="col-12 mt-lg-30">
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mt-lg-15">
        <h4 class="font-weight-100">Need help?</h4>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-hover" data-toggle="site-sidebar" data-url="slide-help-managing-subscriptions">
              <div class="counter counter-lg counter-inverse blue-grey-300 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Managing Subscriptions</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-hover" data-toggle="site-sidebar" data-url="slide-help-ultimate-shop-guide">
              <div class="counter counter-lg counter-inverse blue-grey-300 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Ultimate Shop Guide</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-hover" data-toggle="site-sidebar" data-url="slide-help-withdraw-earnings">
              <div class="counter counter-lg counter-inverse blue-grey-300 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Withdrawing Earnings</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-hover" data-toggle="site-sidebar" data-url="slide-help-creating-a-promotion">
              <div class="counter counter-lg counter-inverse blue-grey-300 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Creating a Promotion</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12">
          <a href="javascript:void(0);" class="card card-block card-hover" data-toggle="site-sidebar" data-url="slide-help-titles">
              <div class="counter counter-lg counter-inverse blue-grey-300 vertical-align h-only-xs-50 h-only-sm-50 h-md-100">
                <div class="vertical-align-middle">
                  <div class="counter-icon mb-5 hidden-md-down"><i class="icon wb-plugin blue-grey-400" aria-hidden="true"></i></div>
                  <span class="counter-number">More Help</span>
                </div>
              </div>
          </a>
      </div>
    </div>
</div>


<div class="modal notification" id="notifications_modal">
  <div class="modal-dialog modal-center">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h3 class="modal-title"><span class="badge badge-info" id="noti_type"></span></h3>
      </div>
      <div class="modal-body text-center">
        <h5 class="font-size-16 font-weight-100" id="noti_message"></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline btn-success" data-dismiss="modal"><i class="wb wb-check"></i></button>
      </div>
    </div>
  </div>
</div>

@endsection



@section('scripts')

<script>
$(window).on('load', function() {
    $.ajax({
        url: '/bknd00/get-servers-and-stores',
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}'
        },
    }).done(function (response) {
        console.log(response);
        
        for (var i = 0; i < response.length; i++) {
          var server = response[i];
          console.log(server[2]);
          if(server[3]){
            var button_text = "Shop";
            var button_link = "/shop/" + server[3];
            var button_class = "btn-success btn-outline";
            if(!server[6]) {
              button_text = "Add Bot";
              button_link = "{{ 'https://discordapp.com/oauth2/authorize?client_id=' . env('DISCORD_CLIENT_ID') . '&scope=bot&permissions=' . env('DISCORD_BOT_PERMISSIONS') }}";
              button_class = "btn-primary btn-outline";
            }
          }else{
            var button_text = "Invite";
            var button_link = "#";
            var button_class = "btn-primary btn-outline";
          }
          if(server[2]){
            var image_url = "https://cdn.discordapp.com/icons/"+server[0]+"/"+server[2]+".png?size=256";
          }else{
            var image_url = "https://i.imgur.com/qbVxZbJ.png";
          }
          var html = `
          <li class="list-group-item px-5">
             <div class="d-flex align-items-start">
               <div class="pl-2 pr-10">
                 <a class="avatar avatar-lg" href="${button_link}">
                   <img class="img-fluid" src="${image_url}" alt="${server[1]}">
                 </a>
               </div>
               <div class="media-body">
                 <h5 class="mt-5 mb-5">${server[1]}</h5>
                 <small>${server[5]}</small>
               </div>
               <div class="pl-5">
                 <a href="${button_link}" class="btn ${button_class} mt-5">${button_text}</a>
               </div>
             </div>
           </li>`
           $('#guilds-dropdown').append(html);
        }

    })
});
</script>

<script type="text/javascript">
        setTimeout(function(){
            if(window.location.href.includes('start')) {
             $("#btn_start-shop-block").addClass("pulse");
            }}, 1000);
</script>

<script>

$(document).on("click", ".open-notification", function () {
     var id = $(this).data('id');
     var type = $(this).data('type');
     var message = $(this).data('message');
     $('#notifications_modal').modal('show');
     if(type == 'success') {
         color = 'success';
     } else if(type == 'warning') {
         color = 'warning';
     } else if(type == 'error') {
         color = 'danger';
     }
     $(".modal.notification #noti_type").addClass('badge-' + color).text( type ).removeClass('badge-info');
     $(".modal.notification #noti_message").text( message );
     $('#notifications_modal').attr('noti-id', id);
     // As pointed out in comments,
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');

      $.ajax({
          url: '/bknd00/mark-notification-read/' + id,
          type: 'GET',
          data: {
              _token: '{{ csrf_token() }}'
          },
      }).done(function (msg) {
        $('#not1fication_' + id).blur().addClass('read').removeClass('unread');
      });

});

$('#notifications_modal').on('hide.bs.modal', function() {
        var id = $(this).data('id');
        $(".modal.notification #noti_type").addClass('badge-info').removeClass('fade badge-success badge-warning badge-danger');

});
</script>


<script type="text/javascript">
  $(window).on('load', function() {
    $("#subscriptionsSlider").slick({
      arrows:false,
      autoplay:true
    });
  });
</script>

<script type="text/javascript">
  setTimeout(function(){
  if(window.location.href.includes('open-servers=true')) {
      $('#servers-block').click()
      }
  },1800);
</script>



<script type="text/javascript">
  setTimeout(function(){
  if(window.location.href.includes('messages')) {
    if(window.location.href.includes('open')) {
      //$('#open-messages').click()
      let searchParams = new URLSearchParams(window.location.search);
      let param_id = searchParams.get('open')
      var url = "slide-ticket-show/" + param_id;
      $("<button>").attr("type", "hidden").attr("data-toggle", "slidePanel").attr("data-url", url).attr("id", "open-message-id_"+param_id).appendTo("body"); 
      $('#open-message-id_'+param_id).click()

      }
    }
  
  },300);
</script>



@foreach(App\Refund::where('owner_id', (Auth::User()->id))->get() as $refundrequest)
@if(!$refundrequest->decision)
<script type="text/javascript">
  setTimeout(function(){
        Swal.fire({
            title: "New Refund Request",
            html: "User: {{ $refundrequest->getUser()->getDiscordHelper()->getUsername() }}<br>Role: {{ $refundrequest->role_name }}<br>Purchase Date: {{ Carbon\Carbon::createFromTimestamp($refundrequest->start_date)->toDateTimeString() }}@if(($refundrequest->refunds_enabled) == '1')<br><br><b>Your Refund Policy: </b>{{ $refundrequest->refund_days }} days, @if(($refundrequest->refund_terms) == '1')No Questions Asked @endif @if(($refundrequest->refund_terms) == '2')by server owner discretion with reason. @endif @endif",
            // html: "<b>Refund Policy:</b> 15 days by server owner discretion with reason.<br>Username: SnowFalls<br>Role: VIP Member<br>Purchase Date: 05/06/19<br>Reason: Here is the request reason the user entered",
            footer: '<span class=\"text-white text-center\"><div class=\"checkbox-custom checkbox-default\"><input type=\"checkbox\" id=\"sub_ban\" name=\\"inputSub_ban\" autocomplete=\"off\"><label for=\"inputSub_ban\">Ban user from future purchases?</label></div></span>',
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, accept refund!',
            cancelButtonText: 'No, deny request.',
            target: document.getElementById('slider-div')
        }).then(function(result){
            if($("#sub_ban").is(':checked')) {
                var subBan = "1";
            }else{
                var subBan = "0";
            }
            if (result.value) {
                $.ajax({
                    url: '/request-subscription-decision',
                    type: 'POST',
                    data: {
                        sub_id: '{{ $refundrequest->sub_id }}',
                        issued: '1',
                        ban: subBan,
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {
                    if (msg['success']) {
                        Swal.fire({
                            title: 'Thank you.',
                            text: 'User notified, subscription cancelled and role removed. Refund queued.',
                            //input: 'checkbox',
                            //inputPlaceholder: 'Ban user from future purchases?',
                            type: 'success',
                            showCancelButton: false,
                        }).then(result => {
                            $('#close-slide').click();
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: msg['msg'],
                            type: 'warning',
                            showCancelButton: false,
                        });
                    }
                })
            }else if(result.dismiss == 'cancel'){

              $.ajax({
                    url: '/request-subscription-decision',
                    type: 'POST',
                    data: {
                        sub_id: '{{ $refundrequest->sub_id }}',
                        issued: '0',
                        ban: subBan,
                        _token: '{{ csrf_token() }}'
                    },
                  }).done(function (msg) {
                    if (msg['success']) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Refund denied. User notified, subscription was not cancelled. Thank you.',
                            //input: 'checkbox',
                            //inputPlaceholder: 'Ban user from future purchases?',
                            type: 'success',
                            showCancelButton: false,
                        }).then(result => {
                            $('#close-slide').click();
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: msg['msg'],
                            type: 'warning',
                            showCancelButton: false,
                        });
                    }
                  })
              }
          })
    },3000);
</script>
@endif
@endforeach

@endsection

